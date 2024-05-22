@extends('Pembina.Components.layout')
<title>SK Legalitas</title>

@section('content')
    <div class="flex flex-col items-center justify-center  ml-4 md:ml-16 lg:ml-20 mr-16 mt-16">
        <div class="flex items-center bg-customBlue text-white w-full h-20">
            <p class="text-2xl font-bold ml-4">SK Legalitas</p>
        </div>
        <div class="bg-customBlue text-customWhite w-full mt-2 border border-customBlack h-16">
            <div class="flex flex-row justify-between p-3 items-center h-full">
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
            @foreach ($skLegalitasData as $index => $data)
            <div class="bg-customWhite w-full md:w-full border h-16 border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-3 h-full items-center">
                    <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['nama_ormawa'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['nomor_sk'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['tanggal_terbit'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['tanggal_berlaku_mulai'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['tanggal_berlaku_selesai'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $data['file_sk'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                        <span class="rounded-full border px-3 py-3 bg-red-600 text-white">{{ $data['status'] }}</span></p>
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

    @include('Ormawa.Components.footer2')
@endsection
