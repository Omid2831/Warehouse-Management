@extends('allergeen.layouts.index')


@section('content')
    <h2 class='text-center text-3xl font-bold text-shadow'>{{ $Metadata['title'] }}</h2>

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto border-4 mt-6">
        <table class="table-fixed border-collapse border border-gray-400 w-full text-center">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Naam Leverancier</th>
                    <th class="border border-gray-400 px-4 py-2">Contactpersoon</th>
                    <th class="border border-gray-400 px-4 py-2">Mobiel</th>
                    <th class="border border-gray-400 px-4 py-2">Stad</th>
                    <th class="border border-gray-400 px-4 py-2">Straat</th>
                    <th class="border border-gray-400 px-4 py-2">Huisnummer</th>
                </tr>
            </thead>
            <tbody>
                @if ($leverancier)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->LeverancierNaam }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Contactpersoon }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Mobiel }}</td>
                        @if ($leverancier->Stad && $leverancier->Straat && $leverancier->Huisnummer)
                            <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Stad }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Straat }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $leverancier->Huisnummer }}</td>
                        @else
                            <td colspan="3" class="border border-gray-400 px-4 py-2 text-red-600 italic">
                                Er zijn geen adresgegevens bekent
                            </td>
                        @endif
                    </tr>
                @else
                    <tr>
                        <td colspan="6" class="border border-gray-400 px-4 py-4 text-gray-500 italic">
                            Geen leverancier gevonden voor dit product.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="javascript:history.back()"
            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded border border-gray-400 transition">
            Terug
        </a>
    </div>
@endsection
