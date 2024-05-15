@extends('Kemahasiswaan.Components.layout')
<title>Tambah SK Legalitas</title>

@section('content')

    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:mt-8 mr-10">
        <div class="items-center justify-center w-3/4 max-w-screen-lg mx-auto">
            <div id="nama_ormawa" class="w-2/3 h-28 border border-customBlue p-4 rounded-lg mx-auto">
                <h3 class="mb-2 font-semibold">Nama Ormawa</h3>
                <textarea id="nama_ormawa" name="nama_ormawa" class="w-full h-12 resize-none rounded-lg border border-customBlue">test</textarea>
            </div>
        </div>
    </div>
    <form action="{{ route('editSKlegalitas.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:mt-8 mr-10">
        <div class="items-center justify-center w-3/4 max-w-screen-lg mx-auto">
            <div id="nomor_SK" class="w-2/3 h-28 border border-customBlue p-4 rounded-lg mx-auto">
                <h3 class="mb-2 font-semibold">Nomor Sk</h3>
                <textarea id="nomor_SK" name="nomor_SK" class="w-full h-12 resize-none rounded-lg border border-customBlue"></textarea>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:mt-8 mr-10">
        <div class="items-center justify-center w-3/4 max-w-screen-lg mx-auto">
            <div id="tanggal_terbit" class="w-2/3 h-28 border border-customBlue p-4 rounded-lg mx-auto">
                <h3 class="mb-2 font-semibold">Tanggal Terbit</h3>
                <input type="date" id="tanggal_terbit" name="tanggal_terbit" class="w-full h-12 rounded-lg border border-customBlue">
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:mt-8 mr-10">
        <div class="items-center justify-center w-3/4 max-w-screen-lg mx-auto">
            <div id="tanggal_berlaku_mulai" class="w-2/3 h-28 border border-customBlue p-4 rounded-lg mx-auto">
                <h3 class="mb-2 font-semibold">Tanggal berlaku mulai</h3>
                <input type="date" id="tanggal_berlaku_mulai" name="tanggal_berlaku_mulai" class="w-full h-12 rounded-lg border border-customBlue">
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:mt-8 mr-10">
        <div class="items-center justify-center w-3/4 max-w-screen-lg mx-auto">
            <div id="tanggal_berlaku_selesai" class="w-2/3 h-28 border border-customBlue p-4 rounded-lg mx-auto">
                <h3 class="mb-2 font-semibold">Tanggal berlaku selesai</h3>
                <input type="date" id="tanggal_berlaku_selesai" name="tanggal_berlaku_selesai" class="w-full h-12 rounded-lg border border-customBlue">
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:mt-8 mr-10">
        <div class="items-center justify-center w-3/4 max-w-screen-lg mx-auto">
            <div class="w-3/4 md:w-3/4 lg:w-2/3 h-auto bg-customWhite border border-customBlue rounded-md mx-auto shadow-xl">
                <p class="ml-2 mt-1 text-base md:text-lg">Unggah dan tambahkan file</p>
                <p class="ml-2 mt-1 text-sm md:text-base">File SK</p>
                <div class="w-10/12 h-32 md:h-36 lg:h-40 mt-4 bg-customWhite border-dashed border-2 border-customBlack rounded-md mx-auto flex flex-col items-center justify-center">
                    <label for="file_SK" class="cursor-pointer flex flex-col items-center">
                        <i class="fas fa-file-alt fa-4x md:fa-5x lg:fa-6x text-customBlack mb-2"></i>
                        <p class="text-xs md:text-sm lg:text-base text-customBlack">Klik untuk Unggah atau seret dan lepas</p>
                        <p class="text-xs md:text-sm lg:text-base text-customBlack">Ukuran maksimal file 5 MB</p>
                    </label>
                    <input id="file_SK" name="file_SK" type="file" class="hidden" />
                </div>
                <div id="loading" class="mt-4 mb-4 w-10/12 h-14 md:h-16 lg:h-20 rounded-md bg-white border border-customBlack opacity-75 mx-auto flex flex-row items-center justify-center relative">
                    <i class="fas fa-file-alt fa-2x md:fa-3x lg:fa-4x text-customBlack ml-2 md:ml-4"></i>
                    <div class="flex flex-col items-start justify-center ml-2 md:ml-4 w-3/4">
                        <p class="text-xs md:text-base lg:text-lg font-bold">File SK</p>
                        <span id="Ukuran" class="text-xxs md:text-xs lg:text-sm text-customBlack">Size:</span>
                        <progress id="file-progress" value="0" max="100" class="w-full h-1 md:h-2 lg:h-3 rounded-lg"></progress>
                    </div>
                    <div class="mr-2 flex flex-col items-end">
                        <i id="CancelBtn" class="fa-solid fa-x fa-xs md:fa-1x lg:fa-2x mb-1 md:mb-2 ml-6 md:ml-10"></i>
                        <span id="Percentage" class="text-xxs md:text-xs lg:text-sm text-customBlack mt-1 md:mt-3 ml-4 md:ml-6">0%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center ml-2 md:ml-16 lg:ml-36 mt-8 ">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan ke Database
        </button>
    </div>
</form>

@include('Ormawa.Components.footer')

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Panggil handleFileUpload untuk elemen fileSk
    handleFileUpload('file_SK');
});

function handleFileUpload(fileId) {
    const fileInput = document.getElementById(fileId);
    const loadingElement = document.getElementById('loading');
    const fileSizeElement = document.getElementById('Ukuran');
    const progressBarElement = document.getElementById('file-progress');
    const percentageElement = document.getElementById('Percentage');
    const cancelBtn = document.getElementById('CancelBtn');

    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        if (!file) return;

        // Tampilkan ukuran file
        fileSizeElement.textContent = `Size: ${formatBytes(file.size)}`;
        
        // Atur progress bar
        progressBarElement.max = file.size;
        progressBarElement.value = 0;
        percentageElement.textContent = '0%';

        // Interval untuk animasi progress bar
        const interval = setInterval(() => {
            progressBarElement.value += Math.floor(Math.random() * (file.size / 10));
            const percentage = (progressBarElement.value / file.size) * 100;
            percentageElement.textContent = `${Math.min(percentage, 100).toFixed(0)}%`;

            // Hentikan interval jika progress bar sudah mencapai akhir
            if (progressBarElement.value >= file.size) {
                clearInterval(interval);
            }
        }, 500);

        // Fungsi untuk membatalkan unggahan
        cancelBtn.addEventListener('click', function() {
            clearInterval(interval);
            fileInput.value = '';
            progressBarElement.value = 0;
            percentageElement.textContent = '0%';
            fileSizeElement.textContent = 'Size: ';
        });
    });
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
}


        </script>

    @endsection