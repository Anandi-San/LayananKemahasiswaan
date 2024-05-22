@extends('Ormawa.Components.layout')
@include('Ormawa.Components.stepper')
<title>Daftar Kegiatan</title>

@section('content')
<div class="flex flex-col items-center justify-center mt-12 ml-4 md:ml-16 lg:ml-20 mr-16">
    <div class="flex items-center bg-customBlue text-white w-full h-20 shadow-lg">
        <p class="text-base md:text-2xl font-bold ml-4">Daftar Kegiatan </p>
        <div class="flex-grow"></div>
        <a href="{{ route('proposalKegiatan') }}" class="flex items-center justify-between w-36 bg-green-500 rounded-lg px-4 py-2 cursor-pointer text-customWhite font-medium no-underline mr-4">
            <i class="fas fa-plus text-customWhite items-center"></i>
            <span class="mr-4 text-lg">Tambah</span>
        </a>
    </div>
    <div class="bg-customBlue text-white w-full mt-2 border border-customBlack overflow-x-auto">
        <div class="flex flex-row justify-between p-2 md:p-4">
            <p class="text-center text-xs md:text-sm">#</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Nama Kegiatan</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Tujuan Kegiatan</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Bentuk Kegiatan</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Operasi</p>
        </div>
    </div>
        @foreach ($proposalKegiatan as $index => $proposal)
            <div class="flex flex-row justify-between border border-customBlack p-2 md:p-4 items-center">
                <p class="flex items-center text-center text-xs md:text-sm ">{{ $index + 1 }}</p>
                <p class="text-justify w-1/6 text-xs md:text-sm mr-1 truncated-text" data-full-text="{{ $proposal->nama_kegiatan }}">
                    {{ \Illuminate\Support\Str::words($proposal->nama_kegiatan, 30, '...') }}
                    @if(\Illuminate\Support\Str::wordCount($proposal->nama_kegiatan) > 30)
                        <a href="#" class="read-more text-customBlue ">selengkapnya</a>
                    @endif
                </p>
                <p class="text-justify w-1/6 text-xs md:text-sm mr-1 truncated-text" data-full-text="{{ $proposal->tujuan_kegiatan }}">
                    {{ \Illuminate\Support\Str::words($proposal->tujuan_kegiatan, 30, '...') }}
                    @if(\Illuminate\Support\Str::wordCount($proposal->tujuan_kegiatan) > 30)
                        <a href="#" class="read-more text-customBlue">selengkapnya</a>
                    @endif
                </p>
                <p class="text-justify w-1/6 text-xs md:text-sm mr-1 truncated-text" data-full-text="{{ $proposal->bentuk_kegiatan }}">
                    {{ \Illuminate\Support\Str::words($proposal->bentuk_kegiatan, 30, '...') }}
                    @if(\Illuminate\Support\Str::wordCount($proposal->bentuk_kegiatan) > 30)
                        <a href="#" class="read-more text-customBlue">selengkapnya</a>
                    @endif
                </p>
                <p class="justify-center text-center w-1/12 text-xs md:text-sm flex items-center font-bold">
                    <span class="rounded-full px-3 py-3 border bg-red-600 text-customWhite inline-block min-w-min max-w-full">{{ $proposal->status ?? 'Belum Unggah'}}</span>
                </p>
                <div class="flex items-center justify-center w-1/6 space-x-2">
                <a href="{{route('proposalKegiatan')}}" class="px-3 py-3 rounded-full bg-customBlack text-white flex items-center justify-center">
                    <i class="fas fa-sync"></i>
                    <span class="ml-2">Update</span>
                </a>
                <a href="#" class="px-3 py-3 rounded-full bg-customBlue text-white flex items-center justify-center">
                    <i class="fas fa-download"></i>
                    <span class="ml-2">Unduh</span>
                </a> 
                </div>
            </div>
        @endforeach
</div>

@include('Ormawa.Components.footer2')
@endsection

<script>
    function addReadMoreListeners() {
        document.querySelectorAll('.read-more').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                let parent = this.parentElement;
                let fullText = parent.getAttribute('data-full-text');
                parent.innerHTML = fullText + ' <a href="#" class="read-less text-customBlue">...kurangi</a>';
                addReadLessListener(parent.querySelector('.read-less'), fullText);
            });
        });
    }

    function addReadLessListener(element, fullText) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            let parent = this.parentElement;
            let truncatedText = fullText.split(' ').slice(0, 30).join(' ') + '... <a href="#" class="read-more text-customBlue">...selengkapnya</a>';
            parent.innerHTML = truncatedText;
            addReadMoreListeners();
        });
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        addReadMoreListeners();
    });
</script>
