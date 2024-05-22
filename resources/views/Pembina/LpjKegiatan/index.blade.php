@extends('Pembina.Components.layout')
<title>LPJ kegiatan</title>

@section('content')
    @extends('Pembina.Components.stepper')

    <div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-20 mr-16">
        <div class="flex items-center bg-customBlue text-white w-full h-20 shadow-lg">
            <p class="text-2xl font-bold ml-4">LPJ Kegiatan</p>
        </div>
        <div class="bg-customBlue text-white w-full shadow-md mt-2 border border-customBlack h-16">
            <div class="flex flex-row justify-between p-2 md:p-4 items-center h-full">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Sampul Depan</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lampiran 1</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lampiran 2</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lampiran 3</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Sampul Belakang</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Operasi</p>    
            </div>
        </div>
        <div class="bg-customWhite w-full shadow-md border  border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-3 items-center">
                @foreach ($lpjKegiatanData as $index => $lpjKegiatan)
                    <p class="text-center w-1/8  text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $lpjKegiatan['sampul_depan'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $lpjKegiatan['lampiran1'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $lpjKegiatan['lampiran2'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $lpjKegiatan['lampiran3'] }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $lpjKegiatan['sampul_belakang'] }}</p>
                    <p class="text-center w-1/12  text-xs md:text-sm mr-1">
                        <span class="rounded-full px-3 py-3 border bg-red-600 text-customWhite inline-block min-w-min max-w-full">
                            {{ $lpjKegiatan->status }}
                        </span></p>
                    <p class="text-center w-1/12 text-xs md:text-xl mr-1 space-x-2">
                        <!-- Unduh dengan ikon -->
                        <a href='#' target="_blank" title="Unduh" class="mx-2">
                            <i class="fas fa-download"></i>
                        </a>
                        <a >|</a>
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </p>               
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-4 mb-12">
        <button
            class="w-48 bg-customWhite border-2 border-customBlue text-customBlack font-bold py-2 px-4 rounded mx-2 mr-12 transition duration-300 hover:border-blue-500">Revisi</button>
        <button
            class="w-48 bg-customWhite border-2 border-customBlue text-customBlack font-bold py-2 px-4 rounded mx-2 ml-12 transition duration-300 hover:border-blue-500">Setujui</button>
    </div>
    @include('Ormawa.Components.footer2')

@endsection
