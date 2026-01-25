<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LeverancierModel extends Model
{
    protected $table = 'Leverancier';

    public function getAllLeverancierData()
    {
        $result = DB::select('CALL sp_getAllLeverancierOverzicht()');
        return $result;
    }

    public function getLeveranciersPaginatedViaSp(int $perPage = 4): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();

        // Fetch current page rows via stored procedure (pageNumber is 1-based)
        $rows = collect(DB::select('CALL sp_getLeverancierInfoPaginated(?, ?)', [$page, $perPage]));

        // Total distinct leveranciers for accurate pagination metadata
        $total = DB::table('Leverancier as L')
            ->join('ProductPerLeverancier as PPL', 'L.Id', '=', 'PPL.LeverancierId')
            ->distinct('L.Id')
            ->count('L.Id');

        return new LengthAwarePaginator(
            $rows,
            $total,
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
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
