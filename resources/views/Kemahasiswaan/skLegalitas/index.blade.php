@extends('Kemahasiswaan.Components.layout')
<title>SK Legalitas</title>

@section('content')
<div class="flex flex-col mt-12 ml-4 md:ml-16 lg:ml-20 mr-16">
    <div class="ml-4">
        <p class="font-bold text-3xl text-customBlack">LPJ Kegiatan</p>
        <p class="font-bold text-2xl mb-2 text-customBlack">Daftar LPJ Kegiatan</p>
        </div>
    <div class="flex items-center justify-between text-white w-full md:w-full h-16 mt-8">
        <label class="flex items-center bg-white rounded-lg px-4 py-2 relative h-10 ml-4 border border-customBlack ">
            <span class="absolute left-0 flex items-center justify-center w-10 h-10">
                <i class="fas fa-search text-customBlack"></i>
            </span>
            <input
                type="text"
                placeholder="Search"
                id="searchInput"
                class="rounded-lg flex-grow px-2 pl-10 focus:outline-none focus:shadow-outline text-black"
                oninput="handleSearch()"
            />
        </label>
        <a href="{{ route('editSKlegalitas.create') }}" class="flex items-center w-36 bg-customBlack rounded-lg px-4 py-2 mr-4 cursor-pointer text-customWhite font-medium no-underline">
            <i class="fas fa-plus text-customWhite mr-2"></i>
            <span>Tambah</span>
        </a>
    </div>
        <div class="bg-customBlue w-full md:w-full border border-customBlack  overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4 text-customWhite">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Nama Ormawa</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Nomor SK</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Terbit</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tangal Berlaku Mulai</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Berlaku Selesai</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">SK Legalitas</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
                <p class="text-center w-36 text-xs md:text-sm mr-1">Operasi</p>
            </div>
        </div>
        <div class="bg-customWhite w-full md:w-11/12 shadow-md overflow-x-auto">
                @foreach ($skLegalitas as $index => $legalitas)
                <div class="flex flex-row justify-between p-2 md:p-4 border-b border-customBlack">
                    <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $legalitas->pengajuanLegalitas->ormawaPembina->ormawa->nama_ormawa }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $legalitas->nomor_SK }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $legalitas->tanggal_terbit }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $legalitas->tanggal_berlaku_mulai }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $legalitas->tanggal_berlaku_selesai }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                        <a href="{{ route('edit_SKlegalitaspdf', ['id' => $legalitas->id, 'type' => 'file_SK']) }}">
                            {{ $legalitas->file_SK }}
                        </a>
                    </p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                        <span class="rounded-lg border px-2 py-1 bg-customBlack text-white">{{ $legalitas->status }}</span></p>
                    <p class="text-center w-36 text-xs md:text-sm">
                        <!-- Unduh dengan ikon -->
                        <a href="{{ asset('storage/sk_legalitas' . $legalitas->sk_legalitas) }}" target="_blank" title="Unduh" class="mx-2">
                            <i class="fas fa-download"></i>
                        </a>
                        
                        <!-- Tambah dengan ikon -->
                        <a href="{{ route('editSKlegalitas.create') }}" title="Tambah" class="mx-2 border-l pl-2 border-gray-300">
                            <i class="fas fa-plus"></i>
                        </a>
                        
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Hapus" class="mx-2 border-l pl-2 border-gray-300">
                            <i class="fas fa-trash"></i>
                        </a>
                    </p>
                    
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('Ormawa.Components.footer2')
@endsection
