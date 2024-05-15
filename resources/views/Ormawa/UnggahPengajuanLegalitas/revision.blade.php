@extends('Ormawa.Components.layout')
<title>Revisi Pengajuan Legalitas</title>

@section('content')
    @extends('Ormawa.Components.stepper')

    @php
        $proposalNames = [
            'Proposal Pengajuan Legalitas',
            'AD_ART',
            'Surat Permohonan',
            'Biodata Pembina',
            'Struktur Organisasi',
            'Daftar Sarana Prasarana',
            'GBHK',
            'LPJ Kepengurusan',
        ];
    @endphp

    <form action="{{ route('revisi.pengajuan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Tambahkan input untuk setiap file yang ingin diunggah -->
        <div class="grid grid-cols-2 grid-rows-2 gap-8">
            @for ($i = 0; $i < count($proposalNames); $i++)
                @component('Ormawa.Components.uploadbox', [
                    'proposal' => $proposalNames[$i],
                    'inputId' => "file-upload-$i",
                    'loadingId' => "loading-$i",
                    'fileSizeId' => "file-size-$i",
                    'progressBarId' => "file-progress-$i",
                    'percentageId' => "upload-percentage-$i",
                    'cancelBtnId' => "cancel-btn-$i",
                ])
                @endcomponent
            @endfor
        </div>
        <div class="flex flex-col items-center justify-center ml-4 md:ml-16 lg:ml-36 mb-12">
            <p class="text-customBlack text-3xl font-semibold mb-4">Daftar Anggota Ormawa</p>

            <div class="flex items-center overflow-x-auto">
                <div class="ml-2 md:ml-12 mb-4 md:mb-8 flex justify-center">
                    <table class="w-full md:w-3/5 table-fixed" id="data-table">
                        <tr class="bg-customWhite border border-gray-500">
                            <th class="w-1/3 sm:w-auto bg-customBlack text-white border border-black px-4 py-2">Nama</th>
                            <th class="w-1/3 sm:w-auto bg-customBlack text-white border border-black px-4 py-2">NIM</th>
                            <th class="w-1/3 sm:w-auto bg-customBlack text-white border border-black px-4 py-2">Posisi</th>
                        </tr>
                        <tr>
                            <td class="w-1/3 sm:w-auto bg-customWhite border border-gray-500 px-4 py-2">
                                <input type="text" name="nama" class="input-nama w-full">
                            </td>
                            <td class="w-1/3 sm:w-auto bg-customWhite border border-gray-500 px-4 py-2">
                                <input type="text" name="nim" class="input-nim w-full">
                            </td>
                            <td class="w-1/3 sm:w-auto bg-customWhite border border-gray-500 px-4 py-2">
                                <input type="text" name="posisi" class="input-posisi w-full">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="mr-0 md:mr-12">
                    <button onclick="addColumn()" class="p-2 bg-green-500 text-white rounded-full mt-4 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Tambahkan tombol submit -->
        <div class="flex justify-center ml-2 md:ml-16 lg:ml-36">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan ke Database
            </button>
        </div>

    </form>



    @include('Ormawa.Components.footer')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @for ($i = 0; $i < count($proposalNames); $i++)
                handleFileUpload({{ $i }});
            @endfor
        });

        function handleFileUpload(index) {
            const inputId = `file-upload-${index}`;
            const loadingId = `loading-${index}`;
            const fileSizeId = `file-size-${index}`;
            const progressBarId = `file-progress-${index}`;
            const percentageId = `upload-percentage-${index}`;
            const cancelBtnId = `cancel-btn-${index}`;

            const fileInput = document.getElementById(inputId);
            const loadingElement = document.getElementById(loadingId);
            const fileSizeElement = document.getElementById(fileSizeId);
            const progressBarElement = document.getElementById(progressBarId);
            const percentageElement = document.getElementById(percentageId);
            const cancelBtn = document.getElementById(cancelBtnId);

            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                if (!file) return;

                fileSizeElement.textContent = `Size: ${formatBytes(file.size)}`;
                progressBarElement.max = file.size;
                progressBarElement.value = 0;
                percentageElement.textContent = '0%';

                const interval = setInterval(() => {
                    progressBarElement.value += Math.floor(Math.random() * (file.size / 10));
                    percentageElement.textContent =
                        `${Math.min(progressBarElement.value / file.size * 100, 100).toFixed(0)}%`;

                    if (progressBarElement.value >= file.size) {
                        clearInterval(interval);
                    }
                }, 500);

                cancelBtn.onclick = function() {
                    clearInterval(interval);
                    fileInput.value = '';
                    progressBarElement.value = 0;
                    percentageElement.textContent = '0%';
                    fileSizeElement.textContent = 'Size: ';
                };
            });
        }

        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        function addColumn() {
            const table = document.getElementById('data-table');
            const newRow = table.insertRow(-1);

            for (let i = 0; i < 3; i++) {
                const cell = newRow.insertCell(i);
                cell.classList.add('bg-customWhite', 'border', 'border-gray-500');

                const input = document.createElement('input');
                input.type = 'text';
                input.name = `column-${i + 1}`;
                input.classList.add(`input-column-${i + 1}`, 'w-full',
                    'sm:w-auto'); // Menambahkan kelas w-full dan sm:w-auto
                cell.appendChild(input);
            }
        }
    </script>

@endsection
