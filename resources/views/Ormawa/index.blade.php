@extends('Ormawa.Components.layout')

@section('content')
<div class="sm:ml-36 ml-4 sm:mt-8 mt-2 mb-12">
    <p class="font-bold text-[32px] pb-1 text-customBlack">Dashboard</p>

    <p class="font-bold text-xl pb-4 mt-2 text-customBlack">Pengajuan Legalitas</p>

    <div class="relative overflow-hidden rounded-2xl h-36 max-w-full mr-5 flex flex-col items-center justify-center">
        <img src="{{ asset('images/background.png') }}" alt="Gambar ITK" class="w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-white opacity-30"></div>
    </div>
    <p class="font-bold text-xl mt-4 text-customBlack">Status Pengajuan Legalitas</p>
    @include('Ormawa.Components.stepper')
    <p class="font-bold text-lg mt-4 text-customBlack">Riwayat Pengajuan Legalitas</p>
    <div class="flex flex-col md:flex-row md:mt-2 mt-0 ">
        <div class="flex flex-row items-center">
            <div class="w-8 md:w-16">
            <i class="fa-solid fa-file-import md:text-6xl text-3xl text-customBlack"></i>
            </div>
            <div class="w-30 ml-2 flex flex-row justify-center items-center">
                <div class="w-48 md:w-60">
                <p class="text-base md:text-lg text-customBlack">Tanggal waktu <br> pengajuan legalitas</p>
                </div>
                <p class="ml-4 mr-4 md:text-5xl text-3xl font-extrabold text-customBlack">:</p>
                <p class="md:text-2xl text-xl text-customBlack">
                    @if(isset($ormawa['pengajuan_legalitas']->created_at))
                        {{ $ormawa['pengajuan_legalitas']->created_at->format('d-m-Y') }}
                    @else
                        Tanggal tidak tersedia
                    @endif
                </p>
            </div>
        </div>
            <div class="md:ml-28 ml-0 md:mt-0 mt-2 flex flex-row items-center">
            <div class="w-8 md:w-16 flex justify-center items-center">
            <i class="fa-solid fa-hourglass-half md:text-6xl text-3xl text-customBlack"></i>
            </div>
            <div class="w-30 ml-2 flex flex-row justify-center items-center">
                <div class="w-48 md:w-60">
                <p class="text-base md:text-lg text-customBlack">Lama waktu <br> pengajuan legalitas</p>
                </div>
                <p class="ml-4 mr-4 md:text-5xl text-3xl font-extrabold text-customBlack">:</p>
                <p class="text-xl md:text-2xl text-customBlack">{{ $pengajuanLegalitasDuration }} Hari</p>
            </div>
        </div>
        </div>

    <p class="font-bold text-xl pb-4 text-customBlack mt-8">Proposal Kegiatan</p>
    
    <div class="relative overflow-hidden rounded-2xl h-36 max-w-full mr-5 flex flex-col items-center justify-center">
        <img src="{{ asset('images/background.png') }}" alt="Gambar ITK" class="w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-white opacity-30"></div>
    </div>
    <p class="font-bold text-xl mt-4 text-customBlack">Status Proposal Kegiatan</p>
    @include('Ormawa.Components.stepper')
    
    <p class="font-bold text-lg mt-4 text-customBlack">Riwayat Proposal Kegiatan</p>
    @foreach($ormawa['proposal_kegiatan'] as $proposal)
        <div class="flex flex-col md:flex-row mt-0 md:mt-2 ">
            <div class="flex flex-row items-center">
                <div class="w-8 md:w-16">
                    <i class="fa-solid fa-file-import md:text-6xl text-3xl text-customBlack"></i>
                </div>
                <div class=" ml-2 flex flex-row justify-center items-center">
                    <div class="w-48 md:w-60">
                        <p class="text-base md:text-lg text-customBlack">Tanggal waktu Pengajuan <br> Proposal Kegiatan</p>
                    </div>
                    <p class="ml-4 mr-4 md:text-5xl text-3xl font-extrabold text-customBlack">:</p>
                    @if ($proposal && $proposal->created_at)
                        <p class="md:text-2xl text-xl text-customBlack">{{ $proposal->created_at->format('d-m-Y') }}</p>
                    @else
                        <p>Data Proposal Kegiatan Tidak Ditemukan</p>
                    @endif
                </div>
            </div>
            <div class="md:ml-28 ml-0 md:mt-0 mt-2 flex flex-row items-center">
                <div class="w-8 md:w-16 flex justify-center items-center">
                    <i class="fa-solid fa-hourglass-half md:text-6xl text-3xl text-customBlack"></i>
                </div>
                <div class=" ml-2 flex flex-row justify-center items-center">
                    <div class="w-48 md:w-60">
                        <p class="text-base md:text-lg text-customBlack">Lama waktu Pengajuan <br> LPJ Kegiatan</p>
                    </div>
                    <p class="ml-4 mr-4 md:text-5xl text-3xl font-extrabold text-customBlack">:</p>
                        @if ($proposal && isset($proposalKegiatanDuration[$proposal->id]))
                            <p class="text-xl md:text-2xl text-customBlack">{{ $proposalKegiatanDuration[$proposal->id] }} Hari</p>
                        @endif
                </div>
            </div>
        </div>
    @endforeach
    

    <p class="font-bold text-xl pb-4 text-customBlack mt-8">LPJ Kegiatan</p>
    <div class="relative overflow-hidden rounded-2xl h-36 max-w-full mr-5 flex flex-col items-center justify-center">
        <img src="{{ asset('images/background.png') }}" alt="Gambar ITK" class="w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-white opacity-30"></div>
    </div>
    <p class="font-bold text-xm pb-4 mt-4 text-customBlack">Status LPJ Kegiatan</p>
    @include('Ormawa.Components.stepper')
    <p class="font-bold text-lg mt-4 text-customBlack">Riwayat LPJ Kegiatan</p>
    @foreach($ormawa['lpj_kegiatan'] as $lpjKegiatan)
        <div class="flex flex-col md:flex-row mt-0 md:mt-2 ">
            <div class="flex flex-row items-center">
                <div class="w-8 md:w-16">
                    <i class="fa-solid fa-file-import md:text-6xl text-3xl text-customBlack"></i>
                </div>
                <div class=" ml-2 flex flex-row justify-center items-center">
                    <div class="w-48 md:w-60">
                        <p class="text-base md:text-lg text-customBlack">Tanggal waktu Pengajuan <br> Proposal Kegiatan</p>
                    </div>
                    <p class="ml-4 mr-4 md:text-5xl text-3xl font-extrabold text-customBlack">:</p>
                    @if ($lpjKegiatan)
                        <p class="md:text-2xl text-xl text-customBlack">{{ $lpjKegiatan->created_at ? $lpjKegiatan->created_at->format('d-m-Y') : '' }}</p>
                    @else
                        <p>Data LPJ Kegiatan Tidak Ditemukan</p>
                    @endif

                </div>
            </div>
            <div class="md:ml-28 ml-0 md:mt-0 mt-2 flex flex-row items-center">
                <div class="w-8 md:w-16 flex justify-center items-center">
                    <i class="fa-solid fa-hourglass-half md:text-6xl text-3xl text-customBlack"></i>
                </div>
                <div class=" ml-2 flex flex-row justify-center items-center">
                    <div class="w-48 md:w-60">
                        <p class="text-base md:text-lg text-customBlack">Lama waktu Pengajuan <br> Proposal Kegiatan</p>
                    </div>
                    <p class="ml-4 mr-4 md:text-5xl text-3xl font-extrabold text-customBlack">:</p>
                        @if ($lpjKegiatan && isset($lpjKegiatanDuration[$lpjKegiatan->id_proposal_kegiatan]))
                            <p class="text-xl md:text-2xl text-customBlack">{{ $lpjKegiatanDuration[$lpjKegiatan->id_proposal_kegiatan] }} Hari</p>
                        @else
                            <p>Data Durasi LPJ Kegiatan Tidak Ditemukan</p>
                        @endif
                </div>
            </div>
        </div>
    @endforeach
    
</div>
@include('Ormawa.Components.footer')
@endsection
