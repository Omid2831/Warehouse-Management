<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assortiment extends Model
{
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
}
