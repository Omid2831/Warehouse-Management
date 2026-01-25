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

    public function getLeveranciersPaginated(int $perPage = 4)
    {
        // Server-side pagination with aggregate counts
        return DB::table('Leverancier as L')
            ->join('ProductPerLeverancier as PPL', 'L.Id', '=', 'PPL.LeverancierId')
            ->select(
                'L.Id',
                'L.Naam',
                'L.Contactpersoon',
                'L.Leveranciernummer',
                'L.Mobiel',
                DB::raw('COUNT(DISTINCT PPL.ProductId) as AantalVerschillendeProducten')
            )
            ->groupBy('L.Id', 'L.Naam', 'L.Contactpersoon', 'L.Leveranciernummer', 'L.Mobiel')
            ->orderBy('L.Naam')
            ->paginate($perPage);
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
