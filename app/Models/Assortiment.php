<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Assortiment extends Model
{
    /**
     * Get all assortiment data by calling the stored procedure sp_getAllOverzichtAssortiment.
     */
    public static function getAllOverzichtAssortiment()
    {
        try {
            $result = DB::select('CALL sp_getAllOverzichtAssortiment()');
            return $result;
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            throw new \Exception('Error fetching assortiment data: ' . $e->getMessage());
        }
    }

    /**
     * Get all assortiment data by calling the datestart and dateend parameters
     * - method used - paginate the results
     */
    public static function getAssortimentByDateRange($startDate, $endDate)
    {
        try {
            return DB::select(
                'CALL sp_getAssortimentByDateRange(?, ?)',
                [$startDate, $endDate]
            );
        } catch (\Exception $e) {
            throw new \Exception(
                'Error fetching assortiment data: ' . $e->getMessage()
            );
        }
    }

    /**
     * Get assortiment details by Id by calling the stored procedure sp_getAssortimentById.
     */
    public static function getAssortimentById(string $id)
    {
        try {
            $result = DB::select('CALL sp_getAssortimentById(?)', [$id]);
            return $result ? $result[0] : null; // Return the first result or null if not found
        } catch (\Exception $e) {
            throw new \Exception('Error fetching assortiment details: ' . $e->getMessage());
        }
    }

    /**
     * Delete assortiment by Id by calling the stored procedure sp_verwijderProductUitAssortiment.
     */
    public static function deleteAssortimentById(string $id)
    {
        try {
            $result = DB::select('CALL sp_verwijderProductUitAssortiment(?)', [$id]);
            // The stored procedure returns a message in the first row, 'message' key
            if (isset($result[0]->message)) {
                return $result[0]->message;
            }
            return null;
        } catch (\Exception $e) {
            throw new \Exception('Error deleting assortiment: ' . $e->getMessage());
        }
    }
}
