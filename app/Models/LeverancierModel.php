<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LeverancierModel extends Model
{
    protected $table = 'Leverancier';
    protected $primaryKey = 'Id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

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

    public function getLeverancierWithContact(int $leverancierId)
    {
        return DB::table('Leverancier as L')
            ->join('Contact as C', 'L.fk_ContactId', '=', 'C.Id')
            ->select(
                'L.fk_ContactId as contact_id',
                'L.Id as Id',
                'L.Id as id',
                'L.Naam as Naam',
                'L.Contactpersoon as Contactpersoon',
                'L.Leveranciernummer as Leveranciernummer',
                'L.Mobiel as Mobiel',
                'C.Straat as Straat',
                'C.Huisnummer as Huisnummer',
                'C.Postcode as Postcode',
                'C.Stad as Stad'
            )
            ->where('L.Id', $leverancierId)
            ->first();
    }
    public function getProductsByLeverancierId($id)
    {
        return DB::select('CALL sp_getProductsByLeverancierId(?)', [$id]);
    }

    public function getGeleverdeProductenOverzicht(
        ?string $startDatum = null,
        ?string $eindDatum = null,
        int $perPage = 7
    ): LengthAwarePaginator {
        $startDatum = $startDatum ?: null;
        $eindDatum = $eindDatum ?: null;

        $page = LengthAwarePaginator::resolveCurrentPage();

        try {
            $rows = collect(DB::select(
                'CALL sp_getGeleverdeProductenOverzicht(?, ?, ?, ?)',
                [$page, $perPage, $startDatum, $eindDatum]
            ));
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'No products available in the selected date range')) {
                $rows = collect();
            } else {
                throw $e;
            }
        }

        $total = DB::table('Leverancier as L')
            ->join('ProductPerLeverancier as PPL', 'L.Id', '=', 'PPL.LeverancierId')
            ->join('Product as P', 'PPL.ProductId', '=', 'P.Id')
            ->when($startDatum, function ($query) use ($startDatum) {
                $query->whereDate('PPL.DatumLevering', '>=', $startDatum);
            })
            ->when($eindDatum, function ($query) use ($eindDatum) {
                $query->whereDate('PPL.DatumLevering', '<=', $eindDatum);
            })
            ->select('L.Id', 'P.Id')
            ->groupBy('L.Id', 'P.Id')
            ->get()
            ->count();

        return new LengthAwarePaginator(
            $rows,
            $total,
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => array_filter([
                    'startdatum' => $startDatum,
                    'einddatum' => $eindDatum,
                ], fn($value) => $value !== null && $value !== ''),
            ]
        );
    }


    public function updateLeverancierAndContact(int $leverancierId, array $payload): bool
    {
        $leverancier = DB::table('Leverancier')->select('fk_ContactId')->where('Id', $leverancierId)->first();

        if (!$leverancier) {
            return false;
        }

        return DB::transaction(function () use ($leverancierId, $leverancier, $payload) {
            $leverancierUpdated = DB::table('Leverancier')
                ->where('Id', $leverancierId)
                ->update([
                    'Naam' => $payload['naam'],
                    'Contactpersoon' => $payload['contactpersoon'],
                    'Leveranciernummer' => $payload['leveranciernummer'],
                    'Mobiel' => $payload['mobiel'],
                ]);

            $contactUpdated = DB::table('Contact')
                ->where('Id', $leverancier->fk_ContactId)
                ->update([
                    'Straat' => $payload['straat'],
                    'Huisnummer' => $payload['huisnummer'],
                    'Postcode' => $payload['postcode'],
                    'Stad' => $payload['stad'],
                ]);

            return $leverancierUpdated !== false && $contactUpdated !== false;
        });
    }
    public function getLeverancierById($id)
    {
        $result = DB::select('SELECT * FROM Leverancier WHERE Id = ?', [$id]);
        return !empty($result) ? $result[0] : null;
    }
}
