@extends('Pembina.Components.layout')
<title>Proposal Kegiatan</title>

@section('content')
    @extends('Pembina.Components.stepper')

    <div class="flex flex-col my-8 ml-4 md:ml-16 lg:ml-20 mr-16">
        <div class="flex items-center bg-customBlue text-white w-full h-20">
            <p class="font-bold text-2xl ml-4">Proposal Kegiatan</p>
        </div>
        <div class="bg-customBlue w-full mt-2 h-16 text-white border border-customBlack">
            <div class="flex flex-row justify-between p-3 items-center h-full">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1 h-full flex items-center justify-center">#</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Sampul Depan
                </p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Lampiran 1</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Lampiran 2</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Lampiran 3</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Sampul
                    Belakang</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Lainnya</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Status</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1 h-full flex items-center justify-center">Operasi</p>
            </div>
        </div>

        @foreach ($proposalKegiatanData as $index => $proposal)
            <div class="bg-customWhite w-full border border-customBlack h-16">
                <div class="flex flex-row justify-between p-3 items-center h-full">
                    <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->first()->sampul_depan }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->first()->lampiran1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->first()->lampiran2 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->first()->lampiran3 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $proposal->first()->sampul_belakang }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                        <span
                            class="rounded-full border px-3 py-3 bg-customBlue text-white">{{ $proposal->first()->status }}</span>
                    </p>
                    <p class="text-center w-1/12 text-xs md:text-xl mr-1">
                        <!-- Unduh dengan ikon -->
                        <a href='#' target="_blank" title="Unduh" class="mr-2">
                            <i class="fas fa-download"></i>
                        </a>
                        |
                        <!-- Hapus dengan ikon -->
                        <a href="#" title="Hapus" class="ml-2">
                            <i class="fas fa-trash text-red-600"></i>
                        </a>
                    </p>
                </div>
            </div>
        @endforeach

    </div>
    {{-- <div class="flex justify-center mt-4 mb-12">
        <button class="w-48 bg-customWhite border-2 border-customBlue text-customBlack font-bold py-2 px-4 rounded mx-2 mr-12 transition duration-300 hover:border-blue-500">Revisi</button>
        <button class="w-48 bg-customWhite border-2 border-customBlue text-customBlack font-bold py-2 px-4 rounded mx-2 ml-12 transition duration-300 hover:border-blue-500">Setujui</button>
    </div> --}}

    @include('Ormawa.Components.footer2')
@endsection
