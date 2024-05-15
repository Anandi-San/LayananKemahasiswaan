    @extends('Ormawa.Components.layout')
    <title>Unggah Proposal Legalitas</title>

    @section('content')
        @extends('Ormawa.Components.stepper')
    <form action="{{ route('proposalkegiatan.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        @php
            $title = ['Judul Kegiatan','Pendahuluan Kegiatan', 'Tujuan Kegiatan', 'Nama Kegiatan', 'Bentuk Kegiatan', 'Sasaran', 'Parameter Keberhasilan', 'Waktu dan Tempat Kegiatan', 'Susunan Acara', 'Rancangan Anggaran Biaya', 'Kepanitiaan', 'Penganggung Jawab', 'Penutup']
        @endphp
        <div class="grid grid-cols-2 grid-rows-2 gap-8">
        @for ($i = 0; $i < count($title); $i++)
            @component('Ormawa.Components.inputBox', [
                'title' => $title[$i],
                'textareaContainer' => "textareaContainer-$i",
                'kegiatanTextArea' => "kegiatanTextArea-$i",
            ])
            @endcomponent
        @endfor

        @php
            $proposalNames = ['Sampul Depan', 'Sampul Belakang', 'Lampiran 1', 'Lampiran 2', 'Lampiran 3'];
        @endphp
        

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
                    input.classList.add(`input-column-${i + 1}`);
                    cell.appendChild(input);
                }
                
            }
        </script>

    @endsection
