@extends('leverancier.layouts.levering')


@section('lerveringInfo')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $title }}</h1>

    <div class="mb-4">
        <p><strong>Product:</strong> {{ $product->ProductNaam ?? 'N/A' }}</p>
        <p><strong>Leverancier:</strong> {{ $product->Leverancier ?? 'N/A' }}</p>
        <p><strong>Contactpersoon:</strong> {{ $product->Contactpersoon ?? 'N/A' }}</p>
        <p><strong>Mobiel:</strong> {{ $product->Mobiel ?? 'N/A' }}</p>
    </div>
@endsection


@section('t_levering')
    <form method="POST" action="{{ route('levering.store', ['id' => $product->Id ?? null]) }}">
        @csrf
        <div class="mb-4">
            <label for="aantal" class="block font-semibold mb-1">Aantal producteenheden</label>
            <input type="text" id="aantal" name="aantal" class="border rounded px-3 py-2 w-full" />
        </div>
        <div class="mb-4">
            <label for="datum" class="block font-semibold mb-1">Datum eerstvolgende levering</label>
            <input type="date" id="datum" name="datum" class="border rounded px-3 py-2 w-full" />
        </div>
        <div class="flex justify-end space-x-4">
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded font-semibold">Sla op</button>
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 rounded font-semibold">Terug</a>
            <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-200 rounded font-semibold">Home</a>
        </div>
        @if (session('melding'))
            <div id="melding"
                style="background: #fff0f0; color: #d32f2f; font-weight: bold; text-align: center; font-size: 1.2rem; border: 2px solid #d32f2f; border-radius: 8px; padding: 24px; margin-top: 20px;">
                {{ session('melding') }}
            </div>
            <script>
                setTimeout(function() {
                    window.location.href =
                        "{{ route('leverancier.show', ['leverancier' => $product->LeverancierId ?? null]) }}";
                }, 4000);
            </script>
        @endif
    </form>
@endsection
