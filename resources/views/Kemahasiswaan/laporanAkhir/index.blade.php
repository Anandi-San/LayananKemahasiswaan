@extends('Kemahasiswaan.Components.layout')
<title>Laporan Akhir</title>

@php
    $states = [
        [
            'state' => '1',
        ],
        [
            'state' => 'Nama Ormawa',
        ],
        [
            'state' => 'Nomor SK',
        ],
        [
            'state' => 'Tanggal Terbit',
        ],
        [
            'state' => 'Tanggal Berlaku Mulai',
        ],
        [
            'state' => 'Tanggal Berlaku Selesai',
        ],
        [
            'state' => 'SK Legalitas',
        ],
        [
            'state' => 'Operasi',
        ],
    ];
@endphp

@section('content')
    <div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-36 mr-4">
        <div class="flex items-center bg-blue-500 text-white w-full md:w-9/12 h-20 shadow-lg">
            <p class="text-base md:text-lg font-bold ml-4">Daftar Proposal Legalitas</p>
        </div>
        <div class="bg-customWhite w-full md:w-9/12 shadow-md mt-2 border border-gray-500 overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Nama Ormawa</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Nomor SK</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Tanggal Terbit</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Tangal Berlaku Mulai</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Tanggal Berlaku Selesai</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">SK Legalitas</p>
                <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Operasi</p>
            </div>
        </div>
        <div class="bg-customWhite w-full md:w-9/12 shadow-md border border-gray-500 overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4">
                @foreach ($states as $state)
                    <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">{!! $state['state'] !!}</p>
                @endforeach
            </div>
        </div>
    </div>

    @include('Ormawa.Components.footer2')
@endsection
