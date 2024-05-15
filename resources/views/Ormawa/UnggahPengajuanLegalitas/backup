@extends('Ormawa.Components.layout')
{{-- @include('Ormawa.Components.stepper') --}}
<title>Revisi Pengajuan Legalitas</title>

@section('content')
<div class="flex flex-col items-center">
    <div class="h-16 w-screen flex items-center justify-between">
        <div class="bg-customWhite h-16 w-screen shadow-2xl hidden md:block"></div>
        <div class="bg-customBlack h-16 w-full md:w-96 flex items-center justify-center">
            <p class="text-white text-center text-lg md:text-2xl">Pengajuan Legalitas</p>
        </div>
    </div>
    <div class="flex flex-col md:flex-row"> <!-- Mengubah flex-row menjadi flex-col untuk tampilan mobile -->
        <div id="boxToRemove" class="bg-customGray h-screen w-1/5 hidden md:block"> <!-- Menambahkan kelas hidden dan md:block untuk menyembunyikan pada tampilan mobile -->
        </div>
        <div class="flex justify-between w-screen">
            <div class="hidden md:block">
            <div id="boxToClick" class="bg-customGray h-screen w-4 ml-6 flex justify-center items-center" onclick="toggleBox()">
                <i class="fa-solid fa-play text-customBlack"></i>
            </div>
            </div>
            <div class="bg-customGray h-screen w-full md:w-3/6"> <!-- Menambahkan kelas w-full untuk tampilan mobile -->
                <img src="{{ asset('images/test.png') }}" alt="Test Image" class="max-w-full h-auto"> <!-- Menambahkan kelas max-w-full untuk gambar responsif -->
            </div>
            <div class="bg-customGray h-screen w-20 md:w-1/5 flex flex-col justify-between">
                <div class="flex flex-col">
                    <div class="text-CustomBlack text-sm md:text-2xl font-bold ml-2 mt-8 md:mt-12">Catatan</div>
                    <hr class="border-b border-customBlack">
                </div>
                <div class="flex items-center justify-center"> <!-- Menambahkan kelas items-center dan justify-center -->
                    <button class="h-12 w-20 md:w-4/5 md:mr-0 mr-2 bg-customBlue text-white font-bold py-3 px-6 rounded mt-4 mb-6 text-sm">Revisi</button> <!-- Mengubah padding vertikal menjadi 3 piksel dan horizontal menjadi 6 piksel -->
                </div>
            </div>
        </div>
    </div>
</div>
    
@include('Ormawa.Components.footer')

<script>
    let boxRemoved = false;

    function toggleBox() {
        var boxToRemove = document.getElementById('boxToRemove');
        if (boxRemoved) {
            boxToRemove.style.display = 'block';
            removeMargin();
        } else {
            boxToRemove.style.display = 'none';
            addMargin();
        }
        boxRemoved = !boxRemoved;
    }

    function addMargin() {
        var boxToClick = document.getElementById('boxToClick');
        boxToClick.style.marginLeft = '144px';
    }

    function removeMargin() {
        var boxToClick = document.getElementById('boxToClick');
        boxToClick.style.marginLeft = '24px';
    }
</script>
@endsection
    