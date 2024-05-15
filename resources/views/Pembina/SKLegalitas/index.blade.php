@extends('Pembina.Components.layout')
<title>SK Legalitas</title>

@section('content')
    <div class="flex flex-col items-center justify-center  ml-4 md:ml-16 lg:ml-36 mr-4 mt-36">
        <div class="flex items-center bg-blue-500 text-white w-full md:w-11/12 h-20 shadow-lg">
            <p class="text-base md:text-lg font-bold ml-4">SK Legalitas</p>
        </div>
        <div class="bg-customWhite w-11/12 md:w-11/12 shadow-md mt-2 border border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Nama Ormawa</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Nomor SK</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Terbit</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tangal Berlaku Mulai</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Tanggal Berlaku Selesai</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">SK Legalitas</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">status</p>
                <p class="text-center w-36 text-xs md:text-sm mr-1">Operasi</p>
            </div>
        </div>
        <div class="container bg-customWhite w-full md:w-11/12 ">
            @foreach ($skLegalitasData as $index => $data)
            <div class="bg-customWhite w-full md:w-full border border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                    <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['nama_ormawa'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['nomor_sk'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['tanggal_terbit'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['tanggal_berlaku_mulai'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['tanggal_berlaku_selesai'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['file_sk'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                        <span class="rounded-lg border px-2 py-1 bg-customBlack text-white">{{ $data['status'] }}</span></p>
                    <p class="text-center w-36 text-xs md:text-xl mr-1">
                        <!-- Unduh dengan ikon -->
                        <a href='#' target="_blank" title="Unduh" class="mr-1">
                            <i class="fas fa-download"></i>
                        </a>
                        |
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Kirim" class="ml-1">
                            <i class="fas fa-file-upload"></i>
                        </a>
                    </p>
                    @endforeach
            </div>
            </div>
        </div>
    </div>

    @include('Ormawa.Components.footer2')
@endsection
