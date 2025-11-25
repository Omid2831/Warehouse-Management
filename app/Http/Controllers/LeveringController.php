<?php

namespace App\Http\Controllers;



use App\Models\LeverancierModel;
use Illuminate\Support\Facades\DB;


class LeveringController extends Controller
{
    public function show($id)
    {
        $levering = DB::table('ProductPerLeverancier')
            ->join('Product', 'ProductPerLeverancier.ProductId', '=', 'Product.Id')
            ->join('Leverancier', 'ProductPerLeverancier.LeverancierId', '=', 'Leverancier.Id')
            ->select(
                'ProductPerLeverancier.Id',
                'Product.Naam as ProductNaam',
                'Leverancier.Id as LeverancierId',
                'Leverancier.Naam as Leverancier',
                'Leverancier.Contactpersoon',
                'Leverancier.Mobiel',
                'ProductPerLeverancier.DatumLevering',
                'ProductPerLeverancier.Aantal',
                'ProductPerLeverancier.DatumEerstVolgendeLevering'
            )
            ->where('ProductPerLeverancier.Id', $id)
            ->first();

        if (!$levering) {
            abort(404, 'Product niet gevonden');
        }

        return view('leverancier.leveringProduct', [
            'product' => $levering,
            'title' => 'Levering Product',
        ]);
    }
    public function store($id)
    {
        // Validate input
        request()->validate([
            'aantal' => 'required|integer',
            'datum' => 'required|date',
        ]);

        // Example: check for Winegums and Basset
        $levering = DB::table('ProductPerLeverancier')
            ->join('Product', 'ProductPerLeverancier.ProductId', '=', 'Product.Id')
            ->join('Leverancier', 'ProductPerLeverancier.LeverancierId', '=', 'Leverancier.Id')
            ->select(
                'Product.Naam as ProductNaam',
                'Leverancier.Naam as Leverancier',
                'Leverancier.Id as LeverancierId'
            )
            ->where('ProductPerLeverancier.Id', $id)
            ->first();

        if ($levering && $levering->ProductNaam === 'Winegums' && $levering->Leverancier === 'Basset') {
            return redirect()->back()->with('melding', 'Het product Winegums van de leverancier Basset wordt niet meer geproduceerd');
        }

        // Otherwise, handle normal logic (e.g., save delivery info)
        // ...

        return redirect()->route('leverancier.show', ['leverancier' => $levering->LeverancierId ?? null]);
    }
}
