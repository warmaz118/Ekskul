@extends('layouts.app')

@section('title', 'Create Ekskul')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Create New Ekskul</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white px-4 py-3 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ekskul.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Divisi</label>
            <select name="divisi_id" class="w-full px-4 py-2 border rounded-md">
                <option value="">Pilih Divisi</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Pembimbing</label>
            <select name="pembimbing_id" class="w-full px-4 py-2 border rounded-md">
                <option value="">Pilih Pembimbing</option>
                @foreach($pembimbings as $pembimbing)
                    <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nama Ekskul</label>
            <input type="text" name="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Hari</label>
            <input type="text" name="hari" class="w-full px-4 py-2 border rounded-md" value="{{ old('hari') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Jam</label>
            <input type="time" name="jam" class="w-full px-4 py-2 border rounded-md" value="{{ old('jam') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" class="w-full px-4 py-2 border rounded-md" value="{{ old('lokasi') }}">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Create Ekskul
            </button>
        </div>
    </form>
</div>
@endsection
