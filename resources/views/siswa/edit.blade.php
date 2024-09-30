@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Edit Siswa</h2>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('POST')

        <!-- Isi form yang sama dengan create.blade.php, tetapi pre-fill data siswa -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="nis">NIS</label>
            <input type="text" name="nis" id="nis" value="{{ old('nis', $siswa->nis) }}" class="shadow appearance-none border rounded w-full py-2 px-3">
        </div>

        <!-- Nama Field -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $siswa->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3">
        </div>

        <!-- Kelas Field -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $siswa->kelas) }}" class="shadow appearance-none border rounded w-full py-2 px-3">
        </div>

        <!-- Alamat Field -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $siswa->alamat) }}" class="shadow appearance-none border rounded w-full py-2 px-3">
        </div>

        <!-- Password Field -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3">
            <p class="text-sm text-gray-600 mt-2">Leave blank if you don't want to change the password.</p>
        </div>

        <!-- Confirm Password Field -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3">
        </div>

        <!-- Role Field -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="role_id">Role</label>
            <select name="role_id" id="role_id" class="shadow appearance-none border rounded w-full py-2 px-3">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $siswa->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Update Siswa
        </button>
    </form>
</div>
@endsection
