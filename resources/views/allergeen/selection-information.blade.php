@extends('allergeen.layouts.index')


@section('content')
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto border-4 mt-4">
        <table class="table-fixed border-collapse border border-gray-400 w-full text-center">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Omschrijving</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($filteredAllergenen as $item)
                        <td class="border border-gray-400 px-4 py-2">{{ $item->Omschrijving ?? 'N/A'}}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection
