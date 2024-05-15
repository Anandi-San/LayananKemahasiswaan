@extends('Kemahasiswaan.Components.layout')
<title>Update Pembina</title>

@section('content')
<form id="ormawaForm" action="{{ route('update.Pembina', ['id' => $pembina->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
        <div class="flex flex-col">
            <div class="flex flex-col w-11/12 justify-start mx-auto">
                <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Update data Pembina</p>
                <p class="font-bold text-xl pb-4 text-customBlack ml-6">Foto Profil</p>
            </div>
            <div class="flex flex-row items-center justify-start mx-auto w-11/12">
                <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4">
                    {{-- Menampilkan foto profil --}}
                    @if($pembina && $pembina->photo_pembina)
                        <img src="{{ asset($pembina->photo_pembina) }}" alt="" class="w-full h-full rounded-full object-cover" style="width: 100%; height: 100%;">
                    @endif
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
                    <label for="nama_pembina" class="font-bold text-xl pb-2 text-customBlack">Nama Pembina</label>
                    <input type="text" id="nama_pembina" name="nama_pembina" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" value="{{ $pembina->nama_pembina ?? '' }}">
                </div>
                
                <!-- Input box status (read-only) -->
                <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                    <label for="status" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Status</label>
                    <input type="text" id="status" name="status" placeholder="Masukkan Status" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" value="{{ $pembina->status ?? 'aktif' }}" readonly>
                </div>
            </div>
            <!-- Tombol simpan -->
            <div class="mt-4 flex flex-col mb-8 w-11/12 mx-auto">
                <button class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
