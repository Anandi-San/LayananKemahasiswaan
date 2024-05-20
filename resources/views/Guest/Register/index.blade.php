@extends('Guest.layout')

@section('content')
<form id="ormawaForm" action="{{route ('register.store')}}" method="POST">
    @csrf
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2">
        <div class="flex flex-col w-11/12 justify-start mx-auto">
            <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Tambah Data Ormawa</p>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="email_pengguna" class="font-bold text-xl pb-2 text-customBlack">Email Pengguna</label>
                <input type="email" id="email_pengguna" name="email_pengguna" placeholder="Masukkan Email" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="nama_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Nama Ormawa</label>
                <input type="text" id="nama_ormawa" name="nama_ormawa" placeholder="Masukkan Nama Ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="jenis_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jenis Ormawa</label>
                <select id="jenis_ormawa" name="jenis_ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
                    <option value="">Pilih Jenis Ormawa</option>
                    <option value="Eksekutif">Eksekutif</option>
                    <option value="Legislatif">Legislatif</option>
                    <option value="UKM">UKM</option>
                </select>
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="nama_dosen_pembina" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Nama Dosen Pembina</label>
                <input type="text" id="nama_dosen_pembina" name="nama_dosen_pembina" placeholder="Masukkan Nama Dosen Pembina" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="nomor_telepon_PIC" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Nomor Telepon PIC</label>
                <input type="text" id="nomor_telepon_PIC" name="nomor_telepon_PIC" placeholder="Masukkan Nomor Telepon PIC" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2">
                <label for="jurusan" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>
        <div class=" flex flex-row py-4 w-11/12 mx-auto">
            <!-- Button Simpan -->
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
        </div>
    </div>
</form>

@include('Ormawa.Components.footer2')
@endsection