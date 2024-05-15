@extends('Ormawa.Components.layout')

@section('content')
<form id="ormawaForm" action="{{ route('ormawa.update.ormawa') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
        <div class="flex flex-col">
            <div class="flex flex-col w-11/12 justify-start mx-auto">
                <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Update Detail Data Ormawa</p>
                <p class="font-bold text-xl pb-4 text-customBlack">Foto Profil</p>
            </div>
            <div class="flex flex-row items-center justify-start mx-auto w-11/12">
                <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4 relative">
                    @if($profil->logo_ormawa)
                        <img src="{{ asset($profil->logo_ormawa) }}" class="absolute inset-0 w-full h-full object-cover rounded-full">
                    @endif
                </div>
                <div class="flex flex-col ml-4">
                    <label for="logo_ormawa" class="bg-customBlue text-white w-52 font-bold py-2 px-4 mr-2 mb-2 rounded-lg cursor-pointer">Unggah Gambar Baru</label>
                    <input type="file" id="logo_ormawa" name="logo_ormawa" accept="image/*" class="hidden">
                    <button type="submit" name="action" value="delete" id="hapusGambarBtn" class="bg-customWhite text-black w-52 border border-red-600 font-bold py-2 px-4 mt-2 rounded-lg">Hapus Gambar</button>
                </div>
            </div>
        </div>

        <!-- Form isian Ormawa -->
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="nama_ormawa" class="font-bold text-xl pb-2 text-customBlack">Nama Ormawa</label>
                <input type="text" id="nama_ormawa" name="nama_ormawa" value="{{ $profil->nama_ormawa }}" placeholder="Masukkan Nama Ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="singkatan_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Singkatan</label>
                <input type="text" id="singkatan_ormawa" name="singkatan_ormawa" value="{{ $profil->singkatan }}" placeholder="Masukkan Singkatan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>

        <!-- Isian lainnya -->
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="jenis_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jenis Ormawa</label>
                <input type="text" id="jenis_ormawa" name="jenis_ormawa" value="{{ $profil->jenis_ormawa }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="jurusan" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="{{ $profil->jurusan }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-4 flex flex-row mb-8 w-11/12 mx-auto">
            <!-- Button Tambahan -->
            <a href="{{ route('index.Kepengurusan') }}" class="sm:w-64 w-full bg-gray-500 text-white font-bold py-2 px-4 rounded-lg text-center mr-6">Update data kepengurusan</a>

            <!-- Button Simpan -->
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
        </div>
    </div>
</form>

@include('Ormawa.Components.footer2')


@endsection
<script>
    document.getElementById('hapusGambarBtn').addEventListener('click', function(event) {
        const form = document.getElementById('ormawaForm');
        form.action = "{{ route('ormawa.update.ormawa') }}";
        form.method = 'POST';
        form.submit();
    });
    </script>
