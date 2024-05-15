@extends('Ormawa.Components.layout')
@include('Ormawa.Components.stepper')
<title>Daftar Kegiatan</title>

@section('content')
<div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-36 mr-4">
    <div class="flex items-center bg-blue-500 text-white w-full md:w-9/12 h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Daftar Kegiatan </p>
        <div class="flex-grow"></div>
        <a href="{{ route('proposalKegiatan') }}" class="flex items-center w-36 bg-white rounded-lg px-4 py-2 cursor-pointer text-customBlack font-medium no-underline mr-4">
            <i class="fas fa-plus text-customBlack mr-2"></i>
            <span>Tambah</span>
        </a>
    </div>
    <div class="bg-customWhite w-full md:w-9/12 shadow-md mt-2 border border-customBlack overflow-x-auto">
        <div class="flex flex-row justify-between p-2 md:p-4 border-b border-customBlack">
            <p class="text-center text-xs md:text-sm">#</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Nama Kegiatan</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1">Operasi</p>
        </div>
        @foreach ($proposalKegiatan as $index => $proposal)
            <div class="flex flex-row justify-between p-2 md:p-4 border-b border-customBlack">
                <p class="flex items-center text-center text-xs md:text-sm ">{{ $index + 1 }}</p>
                <p class="flex items-center justify-center w-1/6 text-xs md:text-sm mr-1">{{ $proposal->nama_kegiatan }}</p>
                <p class="justify-center text-center w-1/12 text-xs md:text-sm flex items-center font-bold">
                    <span class="rounded-full px-2 py-1 border bg-customBlack text-customWhite inline-block min-w-min max-w-full">{{ $proposal->status ?? 'Belum Unggah'}}</span>
                </p>

                <div class="flex items-center justify-center w-1/12">
                    <a href="#" class="text-center text-xs md:text-3xl mr-1">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('Ormawa.Components.footer2')
@endsection
