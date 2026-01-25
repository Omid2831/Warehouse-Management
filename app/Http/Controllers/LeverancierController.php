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
            // Paginate leveranciers via stored procedure (4 per page)
            $leverancierOverzicht = $this->leverancierModel->getLeveranciersPaginatedViaSp(4);

            if ($leverancierOverzicht->isEmpty()) {
                abort(404, 'Geen leveranciers gevonden');
            }

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
    public function show(int $leverancierId)
    {
        $leverancier = $this->leverancierModel->getLeverancierWithContact($leverancierId);

        if (!$leverancier) {
            abort(404, 'Leverancier niet gevonden');
        }

        $products = collect($this->leverancierModel->getProductsByLeverancierId($leverancierId))
            ->sortByDesc('AantalInMagazijn')
            ->values();

        return view('leverancier.show', [
            'leverancier' => $leverancier,
            'products' => $products,
            'title' => 'Leverancier Details',
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $leverancierId)
    {
        $leverancier = $this->leverancierModel->getLeverancierWithContact($leverancierId);

        if (!$leverancier) {
            abort(404, 'Leverancier niet gevonden');
        }

        return view('leverancier.edit', [
            'leverancier' => $leverancier,
            'title' => 'Wijzig Leveranciergegevens',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $leverancierId)
    {
        $leverancier = $this->leverancierModel->getLeverancierWithContact($leverancierId);

        if (!$leverancier) {
            abort(404, 'Leverancier niet gevonden');
        }

        $request->validate([
            'naam' => 'required|string|max:60',
            'contactpersoon' => 'required|string|max:60',
            'leveranciernummer' => 'required|string|max:11',
            'mobiel' => 'required|string|max:15',
            'straat' => 'required|string|max:60',
            'huisnummer' => 'required|integer|min:1',
            'postcode' => 'required|string|max:10',
            'stad' => 'required|string|max:60',
        ]);

        $updated = $this->leverancierModel->updateLeverancierAndContact($leverancierId, $request->only([
            'naam',
            'contactpersoon',
            'leveranciernummer',
            'mobiel',
            'straat',
            'huisnummer',
            'postcode',
            'stad',
        ]));

        if (!$updated) {
            return back()
                ->withInput()
                ->with('error', 'Bijwerken van leveranciergegevens is mislukt. Probeer het later opnieuw.');
        }

        return redirect()
            ->route('leverancier.show', $leverancierId)
            ->with('success', 'Leveranciergegevens zijn opgeslagen.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeverancierModel $leverancierModel)
    {
        //
    }
}
