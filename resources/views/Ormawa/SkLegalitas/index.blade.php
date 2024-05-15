@extends('Ormawa.Components.layout')

@section('content')
    <div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-36 mr-4 mt-36">
        <div class="flex items-center bg-blue-500 text-white w-full md:w-9/12 h-20 shadow-lg">
            <p class="text-base md:text-lg font-bold ml-4">Daftar Proposal Legalitas</p>
        </div>
        <div class="bg-customWhite w-full md:w-9/12 shadow-md mt-2 border border-gray-500 overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
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
        <div class="bg-customWhite w-full md:w-9/12 shadow-md border border-gray-500 overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                @foreach ($skLegalitasData as $index => $skLegalitas)
                    <div class="flex flex-row justify-between w-full">
                        <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['nomor_sk'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['tanggal_terbit'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['tanggal_berlaku_mulai'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['tanggal_berlaku_selesai'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['file_sk'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $skLegalitas['status'] }}</p>
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                        <!-- Unduh dengan ikon -->
                        <a href='#' target="_blank" title="Unduh" class="mx-2">
                            <i class="fas fa-download"></i>
                        </a>
                        
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Hapus" class="mx-2 border-l pl-2 border-gray-300">
                            <i class="fas fa-trash"></i>
                        </a>
                    </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('Ormawa.Components.footer2')
@endsection
