@extends('Pembina.Components.layout')
<title>Proposal Kegiatan</title>

@section('content')
    @extends('Pembina.Components.stepper')

    <div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-36 mr-4">
        <div class="flex items-center bg-blue-500 text-white w-full md:w-11/12 h-20 shadow-lg">
            <p class="text-base md:text-lg font-bold ml-4">Proposal Kegiatan</p>
        </div>
        <div class="bg-customWhite w-full md:w-11/12 shadow-md mt-2 border border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                <p class="text-center w-1/8  text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Sampul Depan</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Lampiran 1</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Lampiran 2</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Lampiran 3</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Sampul Belakang</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Lainnya</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Status</p>
                <p class="text-center w-1/12  text-xs md:text-sm mr-1">Operasi</p>    
            </div>
        </div>

        <!-- Loop melalui data proposal_kegiatan untuk menampilkannya secara dinamis -->
        @foreach ($proposalKegiatanData as $index => $proposal)
        <div class="bg-customWhite w-full md:w-11/12 shadow-sm border border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                <!-- Loop iteration -->
                <p class="text-center w-1/8  text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->sampul_depan }}</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->lampiran1 }}</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->lampiran2 }}</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->lampiran3 }}</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->sampul_belakang }}</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                    <span class="rounded-lg border px-2 py-1 bg-customBlack text-white">{{ $proposal->status }}</span></p>
                <p class="text-center w-1/12 text-xs md:text-xl mr-1">
                        <!-- Unduh dengan ikon -->
                        <a href='#' target="_blank" title="Unduh" class="mr-2">
                            <i class="fas fa-download"></i>
                        </a>
                        |
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Hapus" class="ml-2">
                            <i class="fas fa-trash"></i>
                        </a>
                    </p>   
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-4 mb-12">
        <button class="w-48 bg-customWhite border-2 border-customBlue text-customBlack font-bold py-2 px-4 rounded mx-2 mr-12 transition duration-300 hover:border-blue-500">Revisi</button>
        <button class="w-48 bg-customWhite border-2 border-customBlue text-customBlack font-bold py-2 px-4 rounded mx-2 ml-12 transition duration-300 hover:border-blue-500">Setujui</button>
    </div>

    @include('Ormawa.Components.footer2')
@endsection
