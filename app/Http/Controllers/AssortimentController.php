<?php

namespace App\Http\Controllers;

use App\Models\Assortiment;
use Illuminate\Http\Request;

class AssortimentController extends Controller
{
    private $assortimentModel;

    public function __construct()
    {
        $this->assortimentModel = new Assortiment();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assortimentOverzicht = $this->assortimentModel->getAllOverzichtAssortiment();

        return view('assortiment.index', [
            'title' => 'Assortiment Overzicht',
            'assortiment' => $assortimentOverzicht,
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
