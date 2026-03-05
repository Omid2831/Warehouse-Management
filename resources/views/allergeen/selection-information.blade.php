@extends('allergeen.layouts.index')


@section('content')
    <h2 class='text-center text-3xl font-bold text-shadow'>{{ $Metadata['title'] }}</h2>

    <p class="mt-4 mb-2 text-lg font-semibold">Allergeen: <span class="text-blue-700">{{ $name }}</span></p>

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto border-4 mt-4">
        <table class="table-fixed border-collapse border border-gray-400 w-full text-center">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Naam Product</th>
                    <th class="border border-gray-400 px-4 py-2">Naam Allergeen</th>
                    <th class="border border-gray-400 px-4 py-2">Omschrijving</th>
                    <th class="border border-gray-400 px-4 py-2">Aantal Aanwezig</th>
                    <th class="border border-gray-400 px-4 py-2">info</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $item)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $item->ProductNaam }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $item->AllergeenNaam }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $item->Omschrijving }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $item->AantalAanwezig }}</td>
                        <td class="border border-gray-400 px-4 py-2">
                            <a href="{{ route('allergeen.product-leverancier-info', $item->ProductId) }}"
                                class="text-blue-600 hover:text-blue-800 text-2xl font-bold" title="Leverancier info">
                                ?
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-gray-400 px-4 py-4 text-gray-500 italic">
                            Geen producten gevonden voor dit allergeen.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('allergeen.index') }}"
            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded border border-gray-400 transition">
            Terug
        </a>
    </div>
@endsection
