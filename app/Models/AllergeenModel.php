<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AllergeenModel extends Model
{
    // define the table name
    protected $table = 'Allergeen';


    public function getAllAllergenenData()
    {
        return DB::select('CALL sp_GetAllergenen()');
    }

    /*
     * Create a new allergen
     */
    public static function createAllergeen($naam, $omschrijving)
    {
        try {
            // Call the stored procedure safely
            $result = DB::select('CALL sp_CreateAllergenen(?, ?)', [$naam, $omschrijving]);

            // Check if we got a result
            if (!empty($result) && isset($result[0]->new_id)) {
                return (int) $result[0]->new_id;
            }

            Log::error('Failed to create allergen or no new_id returned.');
        } catch (\Exception $e) {
            Log::error('Error creating allergen: ' . $e->getMessage());
        }
    }

    /**
     * Fiter allergens by name
     * @param string $name The name of the allergen to filter  by name
     */
    public static function filterAllergenenByName(string $name)
    {
        try {
            // Call the stored procedure safely
            $result = DB::select('CALL sp_allergeenSelection(?)', [$name]);
            return $result ?: [];
        } catch (\Exception $e) {
            Log::error('Error filtering allergens: ' . $e->getMessage());
            return [];
        }
    }

    /*
     * Delete an allergen by ID
     */
    public static function DeleteAllergeenById($id)
    {
        try {
            // deleteing the data from the database by id
            $allergeen = DB::select('CALL sp_DeleteAllergenen(?)', [$id]);

            return $allergeen;
        } catch (\Exception $e) {
            Log::error('Error deleting allergen: ' . $e->getMessage());
        }
    }

    /*
     * Update an allergen by ID
     */
    public static function updateAllergeenById($id, $naam, $omschrijving)
    {
        try {
            // getting the data from the database to get 
            $allergeen = DB::select('CALL sp_UpdateAllergeen(?, ?, ?)', [$id, $naam, $omschrijving]);
            return $allergeen;
        } catch (\Exception $e) {
            Log::error('Error updating allergen: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get products per allergen with stock info (for Wireframe-02)
     */
    public static function getProductsPerAllergeen(string $allergeenNaam)
    {
        try {
            return DB::select('
                SELECT
                    P.Id AS ProductId,
                    P.Naam AS ProductNaam,
                    A.Naam AS AllergeenNaam,
                    A.Omschrijving AS Omschrijving,
                    M.AantalAanwezig AS AantalAanwezig
                FROM Product P
                JOIN ProductPerAllergeen PA ON P.Id = PA.ProductId
                JOIN Allergeen A ON PA.AllergeenId = A.Id
                JOIN Magazijn M ON P.Id = M.ProductId
                WHERE A.Naam = ?
                ORDER BY P.Naam ASC
            ', [$allergeenNaam]);
        } catch (\Exception $e) {
            Log::error('Error fetching products per allergen: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get leverancier info for a product (for Wireframe-04)
     */
    public static function getLeverancierByProductId(int $productId)
    {
        try {
            $result = DB::select('
                SELECT
                    L.Naam AS LeverancierNaam,
                    L.Contactpersoon,
                    L.Mobiel,
                    C.Stad,
                    C.Straat,
                    C.Huisnummer
                FROM ProductPerLeverancier PPL
                JOIN Leverancier L ON PPL.LeverancierId = L.Id
                LEFT JOIN Contact C ON L.fk_ContactId = C.Id
                WHERE PPL.ProductId = ?
                LIMIT 1
            ', [$productId]);

            return !empty($result) ? $result[0] : null;
        } catch (\Exception $e) {
            Log::error('Error fetching leverancier by product: ' . $e->getMessage());
            return null;
        }
    }
}
