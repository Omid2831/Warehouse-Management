@extends('leverancier.layouts.index')

@section('content')
    <h2 class='text-center text-3xl font-bold text-shadow mb-6'>{{ $title }}</h2>

    {{-- Date filter form --}}
    <form method="GET" action="{{ route('leverancier.geleverde-producten') }}"
        class="flex flex-wrap items-center gap-4 mb-6">
        <div class="flex items-center gap-2">
            <label for="startdatum" class="font-medium text-gray-700">Startdatum</label>
            <input type="date" id="startdatum" name="startdatum" value="{{ $startDatum ?? '' }}"
                class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400" />
        </div>
        <div class="flex items-center gap-2">
            <label for="einddatum" class="font-medium text-gray-700">Einddatum</label>
            <input type="date" id="einddatum" name="einddatum" value="{{ $eindDatum ?? '' }}"
                class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400" />
        </div>
        <button type="submit"
            class="bg-gray-800 hover:bg-gray-900 text-white font-medium px-5 py-2 rounded-md transition-colors duration-200">
            Maak selectie
        </button>
        @if ($startDatum || $eindDatum)
            <a href="{{ route('leverancier.geleverde-producten') }}"
                class="text-sm text-gray-500 hover:text-gray-700 underline">
                Wis filter
            </a>
        @endif
    </form>

    {{-- Results table --}}
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto border-4">
        <table class="table-fixed border-collapse border border-gray-400 w-full text-center">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Naam Leverancier</th>
                    <th class="border border-gray-400 px-4 py-2">Contactpersoon</th>
                    <th class="border border-gray-400 px-4 py-2">Productnaam</th>
                    <th class="border border-gray-400 px-4 py-2">Totaal geleverd</th>
                    <th class="border border-gray-400 px-4 py-2">Specificatie</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($producten as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-400 px-4 py-2">{{ $product->NaamLeverancier }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $product->Contactpersoon }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $product->Productnaam }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $product->TotaalGeleverd }}</td>
                        <td class="border border-gray-400 px-4 py-2">
                            <a href="{{ route('leverancier.show', $product->LeverancierId) }}"
                                class="inline-flex items-center text-green-600 hover:text-green-800">
                                <i class="bx bxs-detail bx-bounce text-xl" aria-hidden="true"></i>
                                <span class="sr-only">Details van {{ $product->NaamLeverancier }}</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-gray-400 px-4 py-6 text-gray-500">
                            Geen geleverde producten gevonden in deze periode.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
