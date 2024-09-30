@extends('layouts.app')

@section('title', 'Ekskul List')

@section('content')
<div class="container mx-auto p-6">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Ekskul List</h1>
        @auth
        @if(Auth::user()->role->name === 'Admin')
        <a href="{{ route('ekskul.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Create New Ekskul</a>
        @endif
    @endauth
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Divisi
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pembimbing
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Ekskul
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Hari
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jam
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Lokasi
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    @auth
                        @if(Auth::user()->role->name === 'Admin')
                            
                            Actions
                            @endif
                            @endauth
                        </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($ekskuls as $ekskul)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $ekskul->divisi->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $ekskul->pembimbing->name ?? 'No Pembimbing' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $ekskul->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $ekskul->hari }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $ekskul->jam }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $ekskul->lokasi }}
                    </td>
                    @auth
                    @if(Auth::user()->role->name === 'Admin')
                        
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('ekskul.edit', $ekskul->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('ekskul.destroy', $ekskul->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">
                                Delete
                            </button>
                        </form>
                    </td>
                    @endif
                @endauth
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
