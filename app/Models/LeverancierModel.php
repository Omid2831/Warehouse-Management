<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeverancierModel extends Model
{
    protected $table = 'Leverancier';

    public function getAllLeverancierData()
    {
        $result = DB::select('CALL sp_getAllLeverancierOverzicht()');
        return $result;
    }
    public function getProductsByLeverancierId($id)
    {
        return DB::select('CALL sp_getProductsByLeverancierId(?)', [$id]);
    }

    public function getLeverancierById($id)
    {
        $result = DB::select('SELECT * FROM Leverancier WHERE Id = ?', [$id]);
        return !empty($result) ? $result[0] : null;
    }
}
