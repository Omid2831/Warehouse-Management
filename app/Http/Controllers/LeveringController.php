<?php

namespace App\Http\Controllers;



use App\Models\LeverancierModel;
use Illuminate\Support\Facades\DB;


class LeveringController extends Controller
{
    public function show($id)
    {
        $product = DB::table('ProductPerLeverancier')
            ->join('Product', 'ProductPerLeverancier.ProductId', '=', 'Product.Id')
            ->join('Leverancier', 'ProductPerLeverancier.LeverancierId', '=', 'Leverancier.Id')
            ->select(
                'Product.Naam as ProductNaam',
                'Leverancier.Naam as Leverancier',
                'Leverancier.Contactpersoon',
                'Leverancier.Mobiel',
                'ProductPerLeverancier.DatumLevering',
                'ProductPerLeverancier.Aantal',
                'ProductPerLeverancier.DatumEerstVolgendeLevering'
            )
            ->where('ProductPerLeverancier.Id', $id)
            ->first();

        if (!$product) {
            abort(404, 'Product niet gevonden');
        }

        return view('leverancier.leveringProduct', [
            'product' => $product,
            'title' => 'Levering Product',
        ]);
    }
}
