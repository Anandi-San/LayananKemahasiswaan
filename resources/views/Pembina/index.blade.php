@extends('Pembina.Components.layout')
<title>Pembina</title>

@section('content')
    <div class="ml-36 mb-8">
        <p class="font-bold text-3xl text-customBlack mt-12">Halo, Pembina</p>
        <p class="font-bold text-2xl pb-6 text-customBlack">Selamat datang di halaman dashboard Pembina</p>

        <div class="flex justify-between mr-24 mb-28 mt-8">
            <a href="#"
                class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg mr-24 h-44 w-96 justify-center">
                <i class="fa-solid fa-money-bill-1 fa-4x mr-2 mb-1 text-customBlue"></i>
                <p class="text-xl text-customBlack mb-1 font-semibold">RP. 10.500.00</p>
                <p class="text-customBlue">Saldo</p>
            </a>
            <a href="#"
                class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg mr-24 h-44 w-96 justify-center">
                <i class="fa-solid fa-arrow-up fa-4x mr-2 mb-1 text-customBlue "></i>
                <p class="text-xl text-customBlack font-semibold mb-1">Rp. 2.500.00</p>
                <p class="text-customBlue">Dana Terpakai</p>
            </a>
            <a href="#"
                class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg h-44 w-96 justify-center">
                <i class="fa-solid fa-chart-line fa-4x mr-2 mb-1 text-customblue"></i>
                <p class="text-customBlack text-xl font-semibold mb-1">4</p>
                <p class="text-customBlue">Jumlah Kegiatan</p>
            </a>
        </div>

        <div class="flex items-center mb-4">
            <i class="fa-solid fa-clock-rotate-left mr-2 text-customBlack"></i>
            <p class="text-customBlack text-xl mr-2">History</p>

            <div class="relative inline-block text-left">
                <button type="button"
                    class="inline-flex w-96 justify-end gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-customBlack shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                    id="menu-button" aria-haspopup="true">
                    Options
                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="absolute right-0 z-10 mt-2 w-96 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                    id="dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                    tabindex="-1">
                    <div class="py-1" role="none">
                        <a href="#" class="text-customBlack block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-0">tes 1</a>
                        <a href="#" class="text-customBlack block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-1">tes 2</a>
                        <a href="#" class="text-customBlack block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-2">tes 3</a>
                        <a href="#" class="text-customBlack block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                            id="menu-item-3">tes 4</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-customWhite border border-gray-400 rounded-lg mr-24 h-72 flex flex-col">
            <div class="flex items-center mt-2">
                <i class="fa-solid fa-circle-check fa-2x text-customBlue mr-4"></i>
                <div class="flex flex-row justify-between w-full mr-24">
                    <p class="text-customBlack">Pembayaran Panggung</p>
                    <p class="text-customBlack">Rp. 2.500.000</p>
                    <p class="text-customBlack">10/11/2023</p>
                </div>
            </div>
        </div>
    </div>
    @include('Pembina.Components.footer2')

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                var menuButton = document.getElementById('menu-button');
                var dropdownMenu = document.getElementById('dropdown-menu');

                menuButton.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            });
        </script>
@endsection
