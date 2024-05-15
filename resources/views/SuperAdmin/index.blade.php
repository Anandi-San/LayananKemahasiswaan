@extends('SuperAdmin.Components.layout')
<title>Kemahasiswaan</title>

@section('content')
    <p class="font-bold text-3xl text-customBlack mt-20">Halo, SuperAdmin</p>
    <p class="font-bold text-2xl pb-6 text-customBlack">Selamat datang di halaman dashboard Superadmin</p>

    <div class="flex space-x-24 mr-24 mb-28 mt-8">
        <a href="{{ route('profil.kemahasiswaan')}}" class="flex flex-row bg-customWhite border border-gray-400 p-2 rounded-lg h-44 w-96 items-center">
            <i class="fa-solid fa-person fa-7x mb-2 mr-4 text-customBlue"></i>
            <div class="flex-col">
                <p class="text-customBlack text-2xl">Edit Kemahasiswaan</p>
            </div>
        </a>
        <a href="{{ route('history.kemahasiswaan')}}" class="flex flex-row bg-customWhite border border-gray-400 p-2 rounded-lg h-44 w-96 items-center">
        <i class="fa-solid fa-clock-rotate-left fa-7x mb-2 mr-4 text-customBlue"></i>
            <div class="flex-col">
                <p class="text-customBlack text-2xl">History Kemahasiswaan</p>
            </div>
        </a>

@endsection
