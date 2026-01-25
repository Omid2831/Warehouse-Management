@extends('leverancier.layouts.index')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Wijzig Leveranciergegevens</h2>

        @if (session('error'))
            <div id="update-error" class="mb-4 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('leverancier.update', $leverancier->Id ?? $leverancier->id) }}"
            class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            @csrf
            @method('PUT')

            <table class="w-full border-collapse text-left">
                <tbody>
                    <tr class="border-b border-gray-200">
                        <th class="w-1/3 bg-gray-50 px-6 py-3 font-semibold text-gray-700">Naam</th>
                        <td class="px-6 py-3">
                            <input type="text" name="naam" value="{{ old('naam', $leverancier->Naam) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Contactpersoon</th>
                        <td class="px-6 py-3">
                            <input type="text" name="contactpersoon"
                                value="{{ old('contactpersoon', $leverancier->Contactpersoon) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Leveranciernummer</th>
                        <td class="px-6 py-3">
                            <input type="text" name="leveranciernummer"
                                value="{{ old('leveranciernummer', $leverancier->Leveranciernummer) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Mobiel</th>
                        <td class="px-6 py-3">
                            <input type="text" name="mobiel" value="{{ old('mobiel', $leverancier->Mobiel) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Straatnaam</th>
                        <td class="px-6 py-3">
                            <input type="text" name="straat" value="{{ old('straat', $leverancier->Straat) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Huisnummer</th>
                        <td class="px-6 py-3">
                            <input type="number" name="huisnummer"
                                value="{{ old('huisnummer', $leverancier->Huisnummer) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Postcode</th>
                        <td class="px-6 py-3">
                            <input type="text" name="postcode" value="{{ old('postcode', $leverancier->Postcode) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-gray-50 px-6 py-3 font-semibold text-gray-700">Stad</th>
                        <td class="px-6 py-3">
                            <input type="text" name="stad" value="{{ old('stad', $leverancier->Stad) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end space-x-3 px-6 py-4 border-t border-gray-200">
                <button type="submit"
                    class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-150">Sla
                    op</button>
                <a href="{{ route('leverancier.show', $leverancier->Id ?? $leverancier->id) }}"
                    class="px-5 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors duration-150">Annuleer</a>
            </div>
        </form>
    </div>

    @if (session('error') && session('redirect_to'))
        <script>
            setTimeout(function() {
                window.location.href = "{{ session('redirect_to') }}";
            }, 3000);
        </script>
    @endif
@endsection
