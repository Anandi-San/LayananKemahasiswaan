@extends('Ormawa.Components.layout')
@include('Ormawa.Components.stepper')
<title>Daftar Revisi</title>

@php
    $states = [
        [
            'state' => '1',
        ],
        [
            'state' => 'Pengajuan Legalitas',
        ],
        [
            'state' => 'AD/ART',
        ],
        [
            'state' => 'Surat Permohonan',
        ],
        [
            'state' => 'Biodata Pembina',
        ],
        [
            'state' => 'Struktur Organisasi',
        ],
        [
            'state' => 'Daftar Sranasa Prasarana',
        ],
        [
            'state' => 'GBHK',
        ],
        [
            'state' => '<i class="fas fa-check text-lg  text-customBlue"></i>',
        ],
    ]
@endphp

@section('content')
<div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-36 mr-4">
    <div class="flex items-center bg-blue-500 text-white w-full md:w-9/12 h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Daftar Pengajuan Legalitas</p>
    </div>
    <div class="bg-customWhite w-full md:w-9/12 shadow-md mt-2 border border-gray-500 overflow-x-auto">
        <div class="flex flex-row p-2 md:p-4">
            <div class="w-8">
            <p class="text-xs md:text-sm">#</p>
            </div>
            <div class="w-20">
            <p class=" text-xs md:text-sm mr-1">Pengajuan Legalitas</p>
            </div>
            <p class=" text-xs md:text-sm mr-1">AD/ART</p>
            <p class=" text-xs md:text-sm mr-1">Surat Permohonan</p>
            <p class=" text-xs md:text-sm mr-1">Biodata Pembina</p>
            <p class=" text-xs md:text-sm mr-1">Struktur Organisasi</p>
            <p class=" text-xs md:text-sm mr-1">Daftar Sarana Prasarana</p>
            <p class=" text-xs md:text-sm mr-1">GBHK</p>
            <p class=" text-xs md:text-sm">Operasi</p>
        </div>
    </div>
    <div class="bg-customWhite w-full md:w-9/12 shadow-md border border-gray-500 overflow-x-auto">
        <div class="flex flex-row p-2 md:p-4">
            @foreach ($states as $state)
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-2">{!! $state['state'] !!}</p>
            @endforeach
        </div>
    </div>
</div>
    
@include('Ormawa.Components.footer2')
@endsection
