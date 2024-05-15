<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navigation -->
        <!-- Navigation -->
<nav class="bg-gray-100 p-4">
    <div class="container mx-auto flex flex-row items-center">
        <a href="#" class="text-white text-xl font-semibold">
            <img src="{{ asset('images/logo_itk.png') }}" alt="Logo Kemahasiswaan" class="h-14 sm:h-14">
        </a>


    <div class="hidden md:flex flex-1 ml-6">
        <ul class="flex space-x-6 border-b-2 border-gray-700">
            <li><a href="#" class="text-customBlack hover:text-blue-700 active:text-blue-700">UKM</a></li>
            <li><a href="#" class="text-customBlack hover:text-blue-700 active:text-blue-700">Himpunan</a></li>
            <li><a href="#" class="text-customBlack hover:text-blue-700 active:text-blue-700">DPM Prodi</a></li>
            <li><a href="#" class="text-customBlack hover:text-blue-700 active:text-blue-700">KM</a></li>
            <li><a href="#" class="text-customBlack hover:text-blue-700 active:text-blue-700">DPM</a></li>
        </ul>
    </div>


        <ul class="hidden md:flex">
            <li><a href="/login" class="text-white bg-blue-700 px-8 py-2 rounded-lg flex-">Login</a></li>
        </ul>

                <!-- Hamburger Menu for Mobile -->
        <div class="md:hidden flex flex-1 justify-end">
            <button id="menu-toggle" class="text-black focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

    </div>
</nav>


    <div id="menu-overlay" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50">
        <div class="flex justify-end p-4">
            <button id="close-menu" class="text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <ul class="flex flex-col items-center space-y-4">
            <li><a href="#" class="text-white">UKM</a></li>
            <li><a href="#" class="text-white">Himpunan</a></li>
            <li><a href="#" class="text-white">DPM Prodi</a></li>
            <li><a href="#" class="text-white">KM</a></li>
            <li><a href="#" class="text-white">DPM</a></li>
            <li><a href="/login" class="text-white">Login</a></li>
        </ul>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('menu-overlay').classList.toggle('hidden');
        });

        document.getElementById('close-menu').addEventListener('click', function () {
            document.getElementById('menu-overlay').classList.add('hidden');
        });
    </script>

    <header class="bg-gray-100 text-white h-screen flex items-center">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-semibold mb-4" style="color: #3A3A3A">Selamat Datang di Kemahasiswaan</h1>
            <p class="text-lg" style="color: #3A3A3A" >Membangun Masa Depan Bersama</p>
            <a href="#" class="bg-blue-500 text-white px-6 py-3 mt-4 inline-block rounded-full">Pelajari Lebih Lanjut</a>
        </div>
    </header> 
</body>
</html>
 