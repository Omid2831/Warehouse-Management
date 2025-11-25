<?php

namespace App\Http\Controllers;

use App\Models\LeverancierModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeverancierController extends Controller
{

    private $leverancierModel;

    public function __construct()
    {
        $this->leverancierModel = new LeverancierModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // get the leverancier data from the database
            $leverancierOverzicht = $this->leverancierModel->getAllLeverancierData();
            // if there is no data in leverancierOverzicht then show us 404 Error
            if (empty($leverancierOverzicht)) {
                // Will throw HttpException(404) and stop execution
                abort(404, 'Geen leveranciers gevonden');
            }

            // Returning the data to the view
            return view('leverancier.index', [
                'title' => 'Leverancier Overzicht',
                'leveranciers' => $leverancierOverzicht,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // log and return 500
            Log::error('Error fetching Leverancier data: ' . $e->getMessage());

            abort(500, 'Service has been down wait for a bit of time');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LeverancierModel $leverancier)
    {

        $products = collect($this->leverancierModel->getProductsByLeverancierId($leverancier->Id))
            ->sortByDesc('AantalInMagazijn')
            ->values();

        return view('leverancier.show', [
            'leverancier' => $leverancier,
            'products' => $products,
            'title' => 'Geleverde producten',
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeverancierModel $leverancierModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeverancierModel $leverancierModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeverancierModel $leverancierModel)
    {
        //
    }
}
