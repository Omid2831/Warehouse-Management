@extends('leverancier.layouts.show')

@section('leverancierInfo')
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Leverancier Details</h1>
            <div class="flex items-center space-x-3">
                <a href="{{ route('leverancier.edit', $leverancier->Id ?? $leverancier->id) }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors duration-150">Wijzig</a>
                <a href="{{ url()->previous() }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors duration-150">Terug</a>
                <a href="{{ route('home') }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition-colors duration-150">Home</a>
            </div>
        </div>

        @if (session('error'))
            <div class="mx-6 my-4 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mx-6 my-4 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse text-left">
            <tbody>
                <tr class="border-b border-gray-200">
                    <th class="w-1/3 bg-gray-50 px-6 py-3 font-semibold text-gray-700">Naam</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Naam ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Contactpersoon</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Contactpersoon ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Leveranciernummer</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Leveranciernummer ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Mobiel</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Mobiel ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Straatnaam</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Straat ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Huisnummer</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Huisnummer ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Postcode</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Postcode ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Stad</th>
                    <td class="px-6 py-3 text-gray-900">{{ $leverancier->Stad ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('t_leverancier')
    <div class="mt-8 bg-white shadow-lg rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Producten</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-center py-3 px-4 border-b">Naam product</th>
                        <th class="text-center py-3 px-4 border-b">Aantal in Magazijn</th>
                        <th class="text-center py-3 px-4 border-b">Verpakkingseenheid</th>
                        <th class="text-center py-3 px-4 border-b">Laatste levering</th>
                        <th class="text-center py-3 px-4 border-b">Nieuwe levering</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $allEmpty = true;
                        foreach ($products as $product) {
                            if (($product->AantalInMagazijn ?? 0) > 0) {
                                $allEmpty = false;
                                break;
                            }
                        }
                    @endphp
                    @if ($allEmpty)
                        <tr>
                            <td colspan="5"
                                style="background: #fff0f0; color: #d32f2f; font-weight: bold; text-align: center; font-size: 1.1rem; border: 2px solid #d32f2f; border-radius: 8px; padding: 20px;">
                                <span style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#d32f2f"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                                    </svg>
                                    Er is geen voorraad in het magazijn!
                                </span>
                            </td>
                        </tr>
                        <script>
                            setTimeout(function() {
                                window.location.href = "{{ route('leverancier.index') }}";
                            }, 4000);
                        </script>
                    @else
                        @foreach ($products as $product)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="text-center py-3 px-4 border-b">{{ $product->ProductNaam ?? 'N/A' }}</td>
                                <td class="text-center py-3 px-4 border-b">{{ $product->AantalInMagazijn ?? 'N/A' }}</td>
                                <td class="text-center py-3 px-4 border-b">{{ $product->VerpakkingsEenheid ?? 'N/A' }} Kg
                                </td>
                                <td class="text-center py-3 px-4 border-b">{{ $product->LaatsteLevering ?? 'N/A' }}</td>
                                <td class="text-center py-3 px-4 border-b">
                                    <a href="{{ route('levering.show', ['id' => $product->Id]) }}" title="Nieuwe levering">
                                        <button class="text-accecnt py-1 px-3 rounded transparent">
                                            <i class="fa-solid fa-plus font-extrabold text-shadow-xl text-2xl">+</i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
