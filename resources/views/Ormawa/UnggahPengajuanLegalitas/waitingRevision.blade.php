@extends('Ormawa.Components.layout')
@include('Ormawa.Components.stepper')

<title>Menunggu</title>

@php
    $states = [
        [
            'state' => 'Belum Unggah',
            'isSelected' => true,
            'isLast' => false,
        ],
        [
            'state' => 'Menunggu',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Revisi Pembina',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Telah Direvisi',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Disetujui Pembina',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Revisi Kemahasiswaan',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Telah Direvisi',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Disetujui',
            'isSelected' => false,
            'isLast' => false,
        ],
    ];
@endphp

@section('content')
    <div class="flex items-center justify-center my-8 mt-12 mx-4 ml-2 md:ml-36">
    <div class="h-40 md:h-52 w-full md:w-2/5 bg-white border border-customBlue rounded-lg shadow-xl flex flex-col items-center justify-center">
        <div class="flex justify-center items-center w-11/12 h-32 md:h-40 bg-customWhite border-dashed border-2 border-customBlack rounded-md">
            Menunggu Revisi
        </div>
    </div>
</div>

@include('Ormawa.Components.footer2')

@endsection

