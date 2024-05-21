@extends('Kemahasiswaan.Components.layout')

@section('content')
<form id="ormawaForm" action="{{ route('editOrmawa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
        <div class="flex flex-col">
            <div class="flex flex-col w-11/12 justify-start mx-auto">
                <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Tambah Data Ormawa</p>
                <p class="font-bold text-xl pb-4 text-customBlack">Foto Profil</p>
            </div>
            <div class="flex flex-row items-center justify-start mx-auto w-11/12">
                <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4 relative">
                    <!-- Foto profil belum ada karena ini adalah form untuk tambah ormawa baru -->
                </div>
                <div class="flex flex-col ml-4">
                    <label for="logo_ormawa" class="bg-customBlue text-white w-52 font-bold py-2 px-4 mr-2 mb-2 rounded-lg cursor-pointer">Unggah Gambar</label>
                    <input type="file" id="logo_ormawa" name="logo_ormawa" accept="image/*" class="hidden">
                </div>
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="email" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan Email" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="password" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>
        
        <!-- Role -->
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="nama_ormawa" class="font-bold text-xl pb-2 text-customBlack">Nama Ormawa</label>
                <input type="text" id="nama_ormawa" name="nama_ormawa" placeholder="Masukkan Nama Ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="singkatan_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Singkatan</label>
                <input type="text" id="singkatan_ormawa" name="singkatan_ormawa" placeholder="Masukkan Singkatan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>

        <!-- Isian lainnya -->
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
                <label for="jurusan" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jurusan</label>
                <select id="jurusan" name="jurusan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
                    <option value="">Pilih Jurusan</option>
                    <option value="JMTI">JMTI</option>
                    <option value="JSTP">JSTP</option>
                    <option value="JMST">JMST</option>
                    <option value="JTIP">JTIP</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="pembina" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Pembina</label>
                <select id="pembina" name="pembina[]" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
                    <option value="">Pilih Pembina</option>
                    @foreach($pembinas as $pembina)
                    {{-- <option value="">Pilih Pembina</option> --}}
                    <option value="{{ $pembina->id }}">{{ $pembina->nama_pembina }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col md:w-1/2 h-20 mt-4 md:mt-0">
                <label for="tanggal_mulai" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" placeholder="Masukkan Tanggal Mulai" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>

        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col h-20 md:w-1/2">
                <label for="tanggal_selesai" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Tanggal Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" placeholder="Masukkan Tanggal Selesai" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
            </div>
        </div>
        

        <!-- Tombol -->
        <div class=" flex flex-row py-4 w-11/12 mx-auto">
            <!-- Button Simpan -->
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
        </div>
    </div>
</form>

@include('Ormawa.Components.footer')
@endsection
