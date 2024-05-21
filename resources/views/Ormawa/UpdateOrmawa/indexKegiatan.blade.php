@extends('Ormawa.Components.layout')
<title>Daftar Kegiatan</title>

@section('content')
<div class="flex flex-col items-center justify-center mt-16 ml-4 md:ml-16 lg:ml-20 mr-16">
    <div class="flex items-center bg-customBlue text-white w-full h-20">
        <p class="text-base md:text-2xl font-bold ml-4">Daftar Kegiatan</p>
    </div>
    <div class="bg-customBlue w-full shadow-md mt-2 border border-customBlack overflow-x-auto">
        <div class="flex flex-row justify-between p-2 md:p-4 text-white items-center">
            <p class="text-center text-xs md:text-sm">#</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Nama Kegiatan</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Tujuan Kegiatan</p>
            <p class="text-center w-1/6 text-xs md:text-sm mr-1">Bentuk Kegiatan</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
            <p class="text-center w-1/12 text-xs md:text-sm mr-1">Operasi</p>
        </div>
    </div>

        @foreach ($proposalKegiatanOptions as $index => $proposal)
            <div class="flex flex-row justify-between p-2 md:p-4 border border-customBlack items-center">
                <p class="text-xs md:text-sm">{{ $index + 1 }}</p>
                <p class="flex items-center justify-center w-1/6 text-xs md:text-sm mr-1">{{ $proposal->nama_kegiatan }}</p>
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
                <p class="text-center w-1/12 text-xs md:text-sm font-bold">
                    <span class="rounded-full px-3 py-3 border bg-red-600 text-customWhite inline-block min-w-min max-w-full">{{ $proposal->status ?? 'Belum Unggah'}}</span>
                </p>
                <a href="{{ route('edit.Kegiatan', ['id' => $proposal->id]) }}" class="text-center w-1/12 md:w-auto text-xs md:text-sm mr-1">
                <button type="button" class="bg-customBlack hover:bg-green-600 text-white font-bold py-3 px-3 rounded-full flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                        Tambah
                </button>
                </a>
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
