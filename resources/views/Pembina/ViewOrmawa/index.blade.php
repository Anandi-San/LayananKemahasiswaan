@extends('Pembina.Components.layout')
<title>Pembina</title>

@section('content')
    <div class="mx-auto md:ml-36 md:mt-16 mt-8">
        @foreach ($ormawas as $ormawa)
        <div class="mx-auto  md:mt-16 mt-8 flex justify-center"> <!-- Tambahkan class 'flex' dan 'justify-center' -->
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden">
                    <img class="object-center object-cover w-full h-full" src="{{ asset( $ormawa->logo_ormawa) }}" alt="{{ $ormawa->nama_ormawa }}">
                </div>
                <div class="md:ml-4 mt-4 md:mt-0">
                    <p class="font-bold text-2xl text-customBlack">Ouroboros Technologies</p>
                    <p class="text-xl text-customBlack">Ouroboros</p>
                </div>
            </div>
        </div>
        <hr class="w-full border-black my-4 mx-auto md:w-11/12">
        @if($ormawa->pengurusOrmawa->count() > 0)
        <div class="w-full md:w-11/12 mx-auto"> <!-- Menambahkan margin kiri pada tampilan desktop -->
            <p class="font-bold text-xl">Visi</p>
            <p class="text-customBlack">{{ $ormawa->pengurusOrmawa->first()->visi }}</p>
            <p class="font-bold text-xl mt-4">Misi</p>
            @php
                $misiList = explode("\n", $ormawa->pengurusOrmawa->first()->misi);
            @endphp
            <ol class="list-decimal pl-4">
            @foreach ($misiList as $misiItem)
                <li>{{ $misiItem }}</li>
            @endforeach
            </ol>
        </div>
        @endif
        <div class="ormawa-stats flex flex-col md:flex-row justify-center md:space-x-48 mt-8">
            <div class="flex flex-col w-72 mb-8">
                @foreach ($ormawa->ormawaPembina as $ormawaPembina)
                @foreach ($ormawaPembina->pengajuanLegalitas as $pengajuanLegalitas)
                @foreach ($pengajuanLegalitas->skLegalitas as $skLegalitas)
                @foreach ($skLegalitas->proposalKegiatan as $proposalKegiatan)
                @foreach ($proposalKegiatan->monitoringKegiatan as $monitoringKegiatan)
                    <a href="#"
                        class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg w-full h-44 justify-center">
                        <i class="fa-solid fa-money-bill-1 fa-4x mr-2 mb-1 text-customBlue"></i>
                        <p class="text-xl text-customBlack mb-1 font-semibold">RP. {{ number_format($monitoringKegiatan->saldo, 2, ',', '.') }}</p>
                        <p class="text-customBlue">Saldo</p>
                    </a>
                    <a href="#"
                        class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg w-full h-44 justify-center mt-4">
                        <i class="fa-solid fa-arrow-up fa-4x mr-2 mb-1 text-customBlue"></i>
                        <p class="text-xl text-customBlack font-semibold mb-1">RP. {{ number_format($monitoringKegiatan->jumlah_dana, 2, ',', '.') }}</p>
                        <p class="text-customBlue">Dana Terpakai</p>
                    </a>
                @endforeach
                @endforeach
                @endforeach
                @endforeach
                @endforeach
            </div>
                    <div class="flex flex-col w-72 mb-8">
                        <a href="#" class="stat-card flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg w-full h-44 justify-center">
                            <i class="fa-solid fa-chart-line fa-4x mr-2 mb-1 text-customBlue"></i>
                            <p class="text-customBlack text-xl font-semibold mb-1">{{ $ormawa->jumlah_kegiatan }}</p>
                            <p class="text-customBlue">Jumlah Kegiatan</p>
                        </a>
                        <a href="#" class="stat-card flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg w-full h-44 justify-center mt-4">
                            <i class="fa-solid fa-chart-line fa-4x mr-2 mb-1 text-customBlue"></i>
                            <p class="text-customBlack text-xl font-semibold mb-1">{{ $ormawa->jumlah_anggota }}</p>
                            <p class="text-customBlue">Jumlah Anggota</p>
                        </a>
                    </div>
        </div>
        @endforeach
    </div>
    @include('Pembina.Components.footer2')
@endsection
