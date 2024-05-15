@extends('Kemahasiswaan.Components.layout')
<title>Tambah Pembina</title>

@section('content')
<form id="ormawaForm" action="{{route('Pembina.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
        <div class="flex flex-col">
            <div class="flex flex-col w-11/12 justify-start mx-auto">
                <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Tambah Pembina Baru</p>
                <p class="font-bold text-xl pb-4 text-customBlack ml-6">Foto Profil</p>
            </div>
            <div class="flex flex-row items-center justify-start mx-auto w-11/12">
                <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4">
                    {{-- Tempat untuk foto profil --}}
                </div>
                <div class="flex flex-col ml-4">
                    <!-- Input file tersembunyi -->
                    <input type="file" name="photo_pembina" id="photo_pembina-upload" class="hidden">
                
                    <!-- Tombol unggah -->
                    <button class="bg-customBlue text-white w-52 font-bold py-2 px-4 rounded-lg" type="button" onclick="document.getElementById('photo_pembina-upload').click();">
                        Unggah Foto Baru
                    </button>
                </div>
            </div>
            <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
                <!-- Input box nama pembina -->
                <div class="flex flex-col md:w-1/2">
                    <label for="email" class="font-bold text-xl pb-2 text-customBlack">Email</label>
                    <input type="email" id="email" name="email" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" value="">
                </div>
                <div class="flex flex-col md:w-1/2">
                    <label for="password" class="font-bold text-xl pb-2 text-customBlack">Password</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" value="">
                </div>
            </div>
            <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
                <!-- Input box nama pembina -->
                <div class="flex flex-col md:w-1/2">
                    <label for="nama_pembina" class="font-bold text-xl pb-2 text-customBlack">Nama Pembina</label>
                    <input type="text" id="nama_pembina" name="nama_pembina" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" value="">
                </div>
                
                <!-- Input box status (read-only) -->
                <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                </div>
            </div>
            <!-- Tombol simpan -->
            <div class="mt-4 flex flex-col mb-8 w-11/12 mx-auto">
                <button class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg" type="submit">Simpan</button>
            </div>
        </div>
    </div>
    @include('Ormawa.Components.footer2')
</form>

@endsection
