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
}
