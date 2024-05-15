@extends('SuperAdmin.Components.layout')

@section('content')
<div class="sm:ml-36 ml-2 sm:mt-10 mt-2">
    <form action="{{ route('create.kemahasiswaan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col w-11/12 justify-start mx-auto">
            <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Detail Data Kemahasiswaan</p>
            <p class="font-bold text-xl pb-4 text-customBlack">Foto Kemahasiswaan</p>
        </div>
        
        <div class="flex flex-row items-center justify-start mx-auto w-11/12">
            <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4 relative">
                {{-- Tempat gambar akan ditampilkan jika ada gambar --}}
            </div>
            
            <div class="flex flex-col ml-4">
                <label for="logo_kemahasiswaan" class="bg-customBlue text-white w-52 font-bold py-2 px-4 mr-2 mb-2 rounded-lg cursor-pointer">Unggah Gambar Baru</label>
                <input type="file" id="logo_kemahasiswaan" name="logo_kemahasiswaan" accept="image/*" class="hidden">
                
            </div>
        </div>
        
        <!-- Form fields for Kemahasiswaan -->
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="ketua_kemahasiswaan" class="font-bold text-xl pb-2 text-customBlack">Nama Ketua</label>
                <input type="text" id="ketua_kemahasiswaan" name="ketua_kemahasiswaan" placeholder="Masukkan Nama Ketua" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="status" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Status</label>
                <input type="text" id="status" name="status" value="Aktif" placeholder="Masukkan Status" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>
        
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="jabatan_mulai" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jabatan Mulai</label>
                <input type="date" id="jabatan_mulai" name="jabatan_mulai" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="jabatan_selesai" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jabatan Selesai</label>
                <input type="date" id="jabatan_selesai" name="jabatan_selesai" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>
        
        <div class="mt-4 flex flex-row mb-8 w-11/12 mx-auto">
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Tambahkan</button>
        </div>
    </form>
</div>

@include('Ormawa.Components.footer2')
@endsection
