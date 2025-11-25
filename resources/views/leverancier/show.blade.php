@extends('leverancier.layouts.show')

@section('leverancierInfo')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $title }}</h1>

    <div class="mb-4">
        <p><strong>Naam leverancier:</strong> {{ $leverancier->Naam ?? 'N/A' }}</p>
        <p><strong>Contactpersoon leverancier:</strong> {{ $leverancier->Contactpersoon ?? 'N/A' }}</p>
        <p><strong>Leverancier nummer:</strong> {{ $leverancier->Leveranciernummer ?? 'N/A' }}</p>
        <p><strong>Mobiel:</strong> {{ $leverancier->Mobiel ?? 'N/A' }}</p>
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
                            style="background: #fff0f0; color: #d32f2f; font-weight: bold; text-align: center; font-size: 1.2rem; border: 2px solid #d32f2f; border-radius: 8px; padding: 24px;">
                            <span style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#d32f2f"
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
                @endif
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
