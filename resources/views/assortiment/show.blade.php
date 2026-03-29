<!-- Het informatie scherm van een assortiment item -->
@extends('assortiment.layouts.index')


@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Product</h1>
        <div class="bg-white border border-gray-200 rounded shadow p-6">
            <table class="min-w-full">
                <tr>
                    <td class="font-semibold">Naam Product:</td>
                    <td>{{ $assortiment->productNaam ?? '' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Barcode:</td>
                    <td>{{ $assortiment->barcode ?? '' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Bevat gluten:</td>
                    <td>{{ isset($assortiment->allergeenNaam) && $assortiment->allergeenNaam == 'Gluten' ? 'Ja' : 'Nee' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold">Bevat gelatine:</td>
                    <td>{{ isset($assortiment->allergeenNaam) && $assortiment->allergeenNaam == 'Gelatine' ? 'Ja' : 'Nee' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold">Bevat AZO-kleurstof:</td>
                    <td>{{ isset($assortiment->allergeenNaam) && $assortiment->allergeenNaam == 'AZO-kleurstof' ? 'Ja' : 'Nee' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold">Bevat lactose:</td>
                    <td>{{ isset($assortiment->allergeenNaam) && $assortiment->allergeenNaam == 'Lactose' ? 'Ja' : 'Nee' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold">Bevat soja:</td>
                    <td>{{ isset($assortiment->allergeenNaam) && $assortiment->allergeenNaam == 'Soja' ? 'Ja' : 'Nee' }}
                    </td>
                </tr>
            </table>
            <a href="{{ route('assortiment.index') }}"
                class="inline-block mt-6 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Terug naar
                overzicht</a>

            <form action="{{ route('assortiment.destroy', $assortiment->productId) }}" method="POST"
                class="inline-block mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                    onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                    Verwijder
                </button>
            </form>
        </div>
    </div>
@endsection
