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
}
