@extends('leverancier.layouts.index')

@section('content')
    <x-alerts />
    <h2 class='text-center text-3xl font-bold text-shadow'>{{ $title }}</h2>
    <a href="{{ route('leverancier.index') }}"
        class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-5 py-2 rounded-lg border border-gray-300 transition-colors duration-200">
        Overzicht Leverancier
    </a>

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto border-4 mt-4">
        <table class="table-fixed border-collapse border border-gray-400 w-full text-center">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Naam</th>
                    <th class="border border-gray-400 px-4 py-2">ContactPersoon</th>
                    <th class="border border-gray-400 px-4 py-2">leveranciernummer</th>
                    <th class="border border-gray-400 px-4 py-2">mobiel</th>
                    <th class="border border-gray-400 px-4 py-2">Aantal verschillende producten </th>
                    <th class="border border-gray-400 px-4 py-2">Toonproducten</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leveranciers as $leverancier)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Naam }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Contactpersoon }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Leveranciernummer }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Mobiel }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->AantalVerschillendeProducten }}</td>
                        <td class="border border-gray-400 px-4 py-2">
                            <a href="{{ route('leverancier.show', $leverancier->Id) }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <i class="bx bxs-box bx-bounce text-xl" aria-hidden="true"></i>
                                <span class="sr-only">Toon producten van {{ $leverancier->Naam }}</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
