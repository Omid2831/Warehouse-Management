@extends('assortiment.layouts.index')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Overzicht producten uit het assortiment</h1>

        <form method="GET" action="{{ route('assortiment.index') }}" class="flex gap-4 mb-6">
            <label class="flex flex-col">
                <span class="text-sm font-medium">Startdatum:</span>
                <input type="date" name="start_date" value="{{ $startDate ?? '' }}" class="border rounded px-2 py-1">
            </label>
            <label class="flex flex-col">
                <span class="text-sm font-medium">Einddatum:</span>
                <input type="date" name="end_date" value="{{ $endDate ?? '' }}" class="border rounded px-2 py-1">
            </label>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-6">Maak
                selectie</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded shadow">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 font-semibold">Naam Leverancier</th>
                        <th class="px-4 py-2 font-semibold">Contactpersoon</th>
                        <th class="px-4 py-2 font-semibold">Stad</th>
                        <th class="px-4 py-2 font-semibold">Productnaam</th>
                        <th class="px-4 py-2 font-semibold">Einddatum Levering</th>
                        <th class="px-4 py-2 font-semibold">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assortiment as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $item->LeverancierNaam }}</td>
                            <td class="px-4 py-2">{{ $item->Contactpersoon }}</td>
                            <td class="px-4 py-2">{{ $item->Stad }}</td>
                            <td class="px-4 py-2">{{ $item->ProductNaam }}</td>
                            <td class="px-4 py-2">{{ $item->EinddatumLevering }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('assortiment.show', $item->productId) }}"
                                    class="text-blue-600 hover:underline mr-3">Bekijk</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
