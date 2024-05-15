@extends('SuperAdmin.Components.layout')
<title>History Kemahasiswaan</title>

@section('content')
<div class="flex flex-col items-center justify-center my-8 ml-4 md:ml-16 lg:ml-8 mr-4">
    <div class="flex items-center justify-between bg-blue-500 text-white w-full md:w-full h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Daftar Kemahasiswaan</p>
        <div class="flex items-center bg-white rounded-lg px-4 py-2 relative h-10 mr-4">
            <span class="absolute left-0 flex items-center justify-center w-10 h-10">
                <i class="fas fa-search text-customBlack"></i>
            </span>
            <input
                type="text"
                placeholder="Search"
                id="searchInput"
                class="rounded-lg flex-grow px-2 py-2 pl-10 focus:outline-none focus:shadow-outline text-black"
                oninput="handleSearch()"
            />
        </div>
    </div>

<div class="bg-customWhite w-full md:w-full shadow-md mt-2 border custom-black overflow-x-auto">
    <div class="flex flex-row justify-between p-2 md:p-4 border-b border-customBlack">
        <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Logo Kemahasiswaan</p>
        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Ketua Kemahasiswaan</p>
        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Jabatan Mulai</p>
        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Jabatan Selesai</p>
        <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
    </div>

    @foreach ($dataHistoryKemahasiswaan as $index => $data)
        <div class="flex flex-row justify-between p-2 md:p-4 border-black shadow-sm">
            <p class="text-center w-1/8 text-xs md:text-sm mr-1 flex items-center justify-center">{{ $index + 1 }}</p>
            
            <div class="flex justify-center items-center text-center w-1/12 text-xs md:text-sm mr-1">
                <img src="{{ asset($data->logo_kemahasiswaan) }}" alt="Logo Kemahasiswaan" class="w-16 h-16 md:w-24 md:h-24 rounded-full border border-black">
            </div>

            <p class="text-center w-1/12 text-xs md:text-sm mr-1 flex items-center justify-center">{{ $data->ketua_kemahasiswaan }}</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1 flex items-center justify-center">{{ date('d-m-Y', strtotime($data->jabatan_mulai)) }}</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1 flex items-center justify-center">{{ date('d-m-Y', strtotime($data->jabatan_selesai)) }}</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1 flex items-center justify-center">{{ $data->status }}</p>
        </div>
    @endforeach
</div>


</div>

@include('Ormawa.Components.footer2')
@endsection
