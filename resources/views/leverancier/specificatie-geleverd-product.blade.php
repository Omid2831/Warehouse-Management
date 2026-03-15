@extends('leverancier.layouts.index')

@section('content')
    <div class="max-w-4xl mx-auto bg-white border border-gray-300 shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-6 text-gray-800">
            <p><span class="font-semibold">Startdatum:</span> {{ $startDatum ? \Carbon\Carbon::parse($startDatum)->format('d-m-Y') : '-' }}</p>
            <p><span class="font-semibold">Einddatum:</span> {{ $eindDatum ? \Carbon\Carbon::parse($eindDatum)->format('d-m-Y') : '-' }}</p>
            <p><span class="font-semibold">Productnaam:</span> {{ $productInfo->Productnaam ?? '-' }}</p>
            <p><span class="font-semibold">Leverancier:</span> {{ $productInfo->NaamLeverancier ?? '-' }}</p>
            <p class="md:col-span-2">
                <span class="font-semibold">Allergenen:</span>
                {{ $allergenen->isNotEmpty() ? $allergenen->implode(', ') : 'Geen allergenen gevonden' }}
            </p>
        </div>

        <div class="overflow-x-auto border border-gray-300 rounded">
            <table class="min-w-full text-center border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Datum levering</th>
                        <th class="border border-gray-300 px-4 py-2">Aantal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leveringen as $levering)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $levering->DatumLevering }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $levering->Aantal }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="border border-gray-300 px-4 py-6 text-red-600 font-semibold bg-red-50">
                                Geen leveringen gevonden binnen het geselecteerde tijdvak.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('leverancier.geleverde-producten', ['startdatum' => $startDatum, 'einddatum' => $eindDatum]) }}"
                class="inline-flex items-center px-4 py-2 rounded bg-gray-200 text-gray-800 hover:bg-gray-300">
                Terug naar overzicht
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 rounded bg-gray-800 text-white hover:bg-gray-900">
                Home
            </a>
        </div>
    </div>
@endsection
