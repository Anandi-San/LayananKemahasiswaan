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
    ]
@endphp

@section('content')
<div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-36 mr-4">
    <div class="flex items-center bg-blue-500 text-white w-full md:w-9/12 h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Daftar Proposal Legalitas</p>
    </div>
    <div class="bg-customWhite w-full md:w-9/12 shadow-md mt-2 border border-gray-500 overflow-x-auto">
        <div class="flex flex-row justify-between p-2 md:p-4">
            <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">#</p>
            <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">SPJ Kegiatan</p>
            <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Lampiran 1</p>
            <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Lampiran 2</p>
            <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Lampiran 3</p>
            <p class="text-center w-1/8 md:w-auto text-xs md:text-sm mr-1">Sampul Belakang</p>
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
<div class="h-auto">
        @php
            $title = ['Judul LPJ','Pendahuluan LPJ', 'Tujuan LPJ', 'Nama dan Tema Kegiatan', 'Sasaran Kegiatan', 'Laporan Kegiatan', 'Realisasi Pencapaian', 'Evaluasi Kegiatan', 'Susunan Acara', 'Kepanitiaan', 'Dokumentasi Kegiatan', 'Penanggung Jawab Kegiatan', 'Penutup']
        @endphp

        @for ($i = 0; $i < count($title); $i++)
            @component('Ormawa.Components.inputBox', [
                'title' => $title[$i],
                'textareaContainer' => "textareaContainer-$i",
                'kegiatanTextArea' => "kegiatanTextArea-$i",
            ])
            @endcomponent
        @endfor
</div>
    
@include('Ormawa.Components.footer')
@endsection
