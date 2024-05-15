@extends('SuperAdmin.Components.layout')

@section('content')
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
        @foreach ($dataKemahasiswaan as $kemahasiswaan)
        <div class="flex flex-col">
            <div class="flex flex-col w-11/12 justify-start mx-auto">
                <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Detail Data Kemahasiswaan</p>
                <p class="font-bold text-xl pb-4 text-customBlack">Foto Kemahasiswaan</p>
            </div>
            <div class="flex flex-row items-center justify-start mx-auto w-11/12">
                <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4 relative">
                    @if($kemahasiswaan->logo_kemahasiswaan)
                        <img src="{{ asset($kemahasiswaan->logo_kemahasiswaan) }}" class="absolute inset-0 w-full h-full object-cover rounded-full">
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="nama_ormawa" class="font-bold text-xl pb-2 text-customBlack">Nama Ketua</label>
                <input type="text" id="nama_ormawa" name="nama_ormawa" value="{{ $kemahasiswaan->ketua_kemahasiswaan }}" placeholder="Masukkan Nama Ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="singkatan_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Status</label>
                <input type="text" id="singkatan_ormawa" name="singkatan_ormawa" value="{{ $kemahasiswaan->status }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="jenis_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jabatan Mulai</label>
                <input type="text" id="jenis_ormawa" name="jenis_ormawa" value="{{ $kemahasiswaan->jabatan_mulai }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="jurusan" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jabatan Selesai</label>
                <input type="text" id="jurusan" name="jurusan" value="{{ $kemahasiswaan->jabatan_selesai }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
        </div>
        <div class="mt-4 flex flex-row py-2 mb-8 w-11/12 mx-auto">
            <form action="{{ route('kemahasiswaan.nonaktifkan', $kemahasiswaan->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Nonaktifkan</button>
        </form>
        </div>
        @endforeach
    </div>

@include('Ormawa.Components.footer2')
@endsection
