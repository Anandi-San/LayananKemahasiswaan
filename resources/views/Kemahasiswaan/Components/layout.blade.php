<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .textbox {
            position: absolute;
            border: 1px solid #000;
            background-color: transparent;
            padding: 5px;
            resize: both;
            overflow: auto;
            min-width: 50px;
            min-height: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: text;
            z-index: 999;
        }

        .draggable-image {
            position: absolute;
            max-width: 100px;
            cursor: move;
        }

        .resizer {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
        }

        .resizer.active {
            background-color: #4CAF50;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body class="overflow-hidden">
    <div class="flex flex-col justify-between h-screen">
        <main class="overflow-hidden overflow-y-scroll">
            @yield('content')
        </main>

        <script>
            function adjustContentMargin() {
                const footerHeight = document.getElementById('myFooter')?.offsetHeight || 0;
                const content = document.querySelector('main');
                content.style.marginBottom = footerHeight + 'px';
            }

            window.addEventListener('DOMContentLoaded', adjustContentMargin);
            window.addEventListener('resize', adjustContentMargin);
        </script>
    </div>

    <aside id="sidebar" class="absolute top-0 left-0 bg-white w-72 h-screen p-8 rounded-r-[32px] border-r-2 flex-col overflow-y-auto hidden lg:flex">
        <div class="flex flex-col justify-center">
            <div class="flex flex-row items-center mt-4">
                <img src="{{ asset('images/logo_itk.png') }}" alt="Logo ITK" class="size-12 pr-2">
                <div class="text-start">
                    <p class="font-bold text-base">SIM Layanan Kemahasiswaan</p>
                </div>
            </div>
            <hr class="my-6 border-t-2 border-blue-900">
            <a href="{{route('kemahasiswaan')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fas fa-home mr-2 fa-2x"></i>
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">Beranda</p>
                </div>
            </a>
            <a href="{{route('pengajuanlegalitas.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fas fa-envelope-open-text fa-2x mr-2"></i>
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">Pengajuan Legalitas</p>
                </div>
            </a>
            <a href="{{route('proposalKegiatan.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fa-solid fa-file-lines fa-2x mr-2"></i>
                </div>
                <div class="text-start ml-2 items">
                    <p class="font-bold text-base items">Proposal Kegiatan</p>
                </div>
            </a>
            <a href="{{route('LPJKegiatan.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fa-solid fa-file-circle-exclamation fa-2x mr-2"></i>
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">LPJ Kegiatan</p>
                </div>
            </a>
            <a href="{{route('editSKlegalitas.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fa-solid fa-note-sticky fa-2x mr-2"></i>
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">SK Legalitas</p>
                </div>
            </a>
            <a href="{{route('editOrmawa.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fa-solid fa-people-group fa-2x mr-2"></i>
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">Daftar Ormawa</p>
                </div>
            </a>
            <a href="{{route('Pembina.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <i class="fa-solid fa-person fa-2x mr-2"></i>
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">Daftar Pembina</p>
                </div>
            </a>
            <a href="{{route('editProfil.index')}}" class="flex items-center text-customBlack py-2 mt-2">
                <div class="bg-customWhite rounded-full w-10">
                    <img src="{{ asset('images/logo_itk.png') }}" alt="User Icon" class="w-8 h-8 rounded-full mr-2">
                </div>
                <div class="text-start ml-2">
                    <p class="font-bold text-base">User</p>
                </div>
            </a>
        </div>
        <div class="mt-auto">
            <form id="logoutForm" action="{{ route('logout') }}" method="GET" class="absolute bottom-4">
                @csrf
                <button type="submit" class="flex items-center text-customBlack px-1 py-2 mt-4" title="Logout">
                    <div class="bg-customWhite rounded-full w-10">
                        <i class="fas fa-sign-out-alt mr-2 fa-2x"></i>
                    </div>
                    <div class="text-start ml-4">
                        <p class="font-bold text-base">Logout</p>
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <div id="sidebarToggle" class="absolute top-4 left-4 cursor-pointer">
        <i class="fas fa-bars fa-2x text-customBlack"></i>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>
