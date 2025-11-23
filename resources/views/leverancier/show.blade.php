@extends('leverancier.layouts.show')

@section('leverancierInfo')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $title }}</h1>

    <div class="mb-4">
        <p><strong>Naam leverancier:</strong> {{ $product->Naam ?? 'N/A' }}</p>
        <p><strong>Contactpersoon leverancier:</strong> {{ $product->Contactpersoon ?? 'N/A' }}</p>
        <p><strong>Leverancier nummer:</strong> {{ $product->Leveranciernummer ?? 'N/A' }}</p>
        <p><strong>Mobiel:</strong> {{ $product->Mobiel ?? 'N/A' }}</p>
    </div>
@endsection

@section('t_leverancier')
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Producten</h2>

        <table class="min-w-full bg-white border-4 border-dashed">
            <thead>
                <tr>
                    <th class="text-center py-2 px-4 border-b">Naam product</th>
                    <th class="text-center py-2 px-4 border-b">Aantal in Magazijn</th>
                    <th class="text-center py-2 px-4 border-b">Verpakkingseenheid</th>
                    <th class="text-center py-2 px-4 border-b">Laatste levering</th>
                    <th class="text-center py-2 px-4 border-b">Nieuwe levering</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="text-center py-2 px-4 border-b">{{ $product->ProductNaam ?? 'N/A' }}</td>
                        <td class="text-center py-2 px-4 border-b">{{ $product->AantalInMagazijn ?? 'N/A' }}</td>
                        <td class="text-center py-2 px-4 border-b">{{ $product->VerpakkingsEenheid ?? 'N/A' }} Kg</td>
                        <td class="text-center py-2 px-4 border-b">{{ $product->LaatsteLevering ?? 'N/A' }}</td>
                        <td class="text-center py-2 px-4 border-b">
                            <a href="{{ route('levering.show', ['id' => $product->Id]) }}" title="Nieuwe levering">
                                <button class="text-accecnt py-1 px-3 rounded transparent">
                                    <i class="fa-solid fa-plus font-extrabold text-shadow-xl text-2xl">+</i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-6 space-x-4">
            <a href="{{ url()->previous() }}"
                class="px-4 py-2 bg-gray-200 rounded font-semibold text-shadow-2xs hover:bg-gray-300">Terug</a>
            <a href="{{ route('home') }}"
                class="px-4 py-2 bg-gray-600 text-white font-semibold text-shadow-2xs rounded hover:bg-gray-700">Home</a>
        </div>
    </div>
@endsection
