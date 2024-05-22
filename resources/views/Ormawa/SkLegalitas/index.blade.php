@extends('Ormawa.Components.layout')

@section('content')
    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-20 mt-16 mr-16">
        <div class="flex items-center bg-customBlue text-white w-full h-20 shadow-lg">
            <p class="text-2xl md:text-2xl font-bold ml-4">Daftar SK Legalitas</p>
        </div>
        <div class="bg-customBlue text-white w-full shadow-md mt-2 border border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4 items-center">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Nomor SK</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Terbit</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Berlaku Mulai</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Berlaku Selesai</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">SK Legalitas</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Operasi</p>
            </div>
        </div>
        <div class="bg-customWhite w-full shadow-md overflow-x-auto">
                @foreach ($skLegalitasData as $index => $skLegalitas)
                <div class="flex flex-row justify-between p-2 md:p-4 border border-customBlack">
                    <div class="flex flex-row justify-between w-full items-center">
                        <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['nomor_sk'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['tanggal_terbit'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['tanggal_berlaku_mulai'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['tanggal_berlaku_selesai'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['file_sk'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                        <p class="justify-center text-center w-1/12 text-xs md:text-sm flex items-center font-bold">
                            <span class="rounded-full px-3 py-3 border bg-red-600 text-customWhite inline-block min-w-min max-w-full">{{ $skLegalitas['status'] }}</span>
                        </p> 
                        <p class="text-center w-1/12 text-2xl">
                        <!-- Unduh dengan ikon -->
                        <a href='#' target="_blank" title="Unduh" class="mx-2">
                            <i class="fas fa-download text-2xl"></i>
                        </a>
                        |
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Hapus" class="mx-2  border-gray-300">
                            <i class="fas fa-trash text-2xl"></i>
                        </a>
                    </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('Ormawa.Components.footer2')
@endsection
