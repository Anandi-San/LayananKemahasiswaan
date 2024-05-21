@extends('Ormawa.Components.layout')
@include('Ormawa.Components.stepperPengajuan')

<title>Disetujui</title>

@section('content')
<div class="flex flex-col items-center justify-center mt-12 ml-4 md:ml-16 lg:ml-20 mr-16">
    <div class="flex items-center bg-customBlue text-white w-full h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Daftar Pengajuan Legalitas</p>
    </div>
    <div class="bg-customBlue w-full shadow-md mt-2 border border-gray-500 overflow-x-auto">
        <div class="flex flex-row justify-between p-2 md:p-4 text-white items-center">
            <p class="text-xs md:text-sm mr-1">#</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">Pengajuan Legalitas</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">AD/ART</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">Surat Permohonan</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">Biodata Pembina</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">Struktur Organisasi</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">Daftar Sarana Prasarana</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">Daftar Anggota Ormawa</p>
            <p class="text-center text-xs w-1/12 md:text-sm mr-1">GBHK</p>
            <p class="text-center text-xs w-1/12 md:text-sm">Operasi</p>
        </div>
    </div>
    <div class="bg-customWhite w-full shadow-md border border-customBlack overflow-x-auto">
        @foreach($legalitas as $index => $item)
            <div class="flex flex-row justify-between p-2 md:p-4 items-center">
                <p class="text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->proposal_legalitas }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->AD_ART }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->surat_permohonan }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->biodata_pembina }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->struktur_organisasi }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->daftar_sarana_prasarana }}</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">Daftar Anggota Ormawa</p>
                <p class="text-center text-xs w-1/12 md:text-sm mr-1">{{ $item->GBHK }}</p>
                <div class="flex items-center justify-center w-1/12">
                    <a href="{{ route('revision') }}" class="px-3 py-3 rounded-full bg-customBlue text-white flex items-center justify-center">
                        <i class="fas fa-download"></i>
                        <span class="ml-2">Unduh</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('Ormawa.Components.footer2')
@endsection
