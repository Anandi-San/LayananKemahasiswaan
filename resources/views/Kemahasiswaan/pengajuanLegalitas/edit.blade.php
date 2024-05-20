@extends('Kemahasiswaan.Components.layout')
{{-- @section('title', 'Membuka File PDF Lokal') --}}

@section('content')
    <div class="flex flex-col items-center">
        <div class="h-16 w-screen flex items-center justify-between">
            <div class="bg-customWhite h-16 w-screen shadow-2xl hidden md:block text-center">
                <button id="toggle-draw" class="bg-blue-500 text-white px-4 py-2 rounded">Aktifkan Coretan</button>
                <button id="add-textbox" class="bg-green-500 text-white px-4 py-2 rounded">Tambahkan Textbox</button>
                <input type="file" id="upload-image" class="hidden" accept="image/*">
                <button id="add-image" class="bg-red-500 text-white px-4 py-2 rounded">Tambahkan Gambar</button>
                <button id="download-pdf" class="bg-red-500 text-white px-4 py-2 rounded">Download PDF</button>
            </div>
            <div class="bg-customBlack h-16 w-full md:w-96 flex items-center justify-center">
                <p class="text-white text-center text-lg md:text-2xl">Proposal Kegiatan</p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row"> <!-- Mengubah flex-row menjadi flex-col untuk tampilan mobile -->
            <div class="flex justify-between w-screen">
                <div class="hidden md:block">
                </div>
                <div class="bg-customGray h-screen w-full md:w-3/6 flex justify-center items-center">
                    <!-- Menambahkan kelas justify-center dan items-center untuk posisikan kontainer di tengah -->
                    <div id="pdf-viewer" class="w-full h-full"></div>
                </div>

                <div class="bg-customGray h-screen w-20 md:w-1/5 flex flex-col justify-between">
                    <div class="flex flex-col">
                        <div class="text-CustomBlack text-sm md:text-2xl font-bold ml-2 mt-8 md:mt-12">Catatan</div>
                        <hr class="border-b border-customBlack">
                    </div>
                    <div class="flex items-center justify-center">
                        <!-- Menambahkan kelas items-center dan justify-center -->
                        <button
                            class="h-12 w-20 md:w-4/5 md:mr-0 mr-2 bg-customBlue text-white font-bold py-3 px-6 rounded mt-4 mb-6 text-sm">Revisi</button>
                        <!-- Mengubah padding vertikal menjadi 3 piksel dan horizontal menjadi 6 piksel -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Ormawa.Components.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="{{ asset('pdfjs/build/pdf.mjs') }}" type="module"></script>
    <script type="module">
        var { pdfjsLib } = globalThis;

        // Atur path ke direktori PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('pdfjs/build/pdf.worker.mjs') }}";

        async function displayPDF() {
            const pdfPath = "{{ asset('example.pdf') }}"; // Ganti dengan path ke file PDF Anda

            try {
                const pdf = await pdfjsLib.getDocument(pdfPath).promise;
                const totalPages = pdf.numPages;

                // Dapatkan konteks canvas
                const canvasContainer = document.getElementById('pdf-viewer');
                const toggleDrawButton = document.getElementById('toggle-draw');
                const addTextboxButton = document.getElementById('add-textbox');
                const addImageButton = document.getElementById('add-image');
                const uploadImageInput = document.getElementById('upload-image');
                const downloadPdfButton = document.getElementById('download-pdf');

                // Buat variabel untuk menyimpan data coretan dan textbox
                const annotations = [];
                let isDrawing = false;

                // Inisialisasi event listener untuk menggambar coretan
                let lastX = 0;
                let lastY = 0;

                toggleDrawButton.addEventListener('click', () => {
                    isDrawing = !isDrawing; // Mengubah status mode mencoret
                    toggleDrawButton.textContent = isDrawing ? 'Nonaktifkan Coretan' : 'Aktifkan Coretan';
                });

                canvasContainer.addEventListener('mousedown', (e) => {
                    if (isDrawing) {
                        const rect = canvas.getBoundingClientRect();
                        [lastX, lastY] = [e.clientX - rect.left, e.clientY - rect.top];
                    }
                });


                canvasContainer.addEventListener('mousemove', (e) => {
                    if (!isDrawing) return;
                    if (!e.buttons) return; // Coretan hanya dibuat saat tombol mouse ditekan
                    const canvas = e.target;
                    const context = canvas.getContext('2d');

                    // Gambar garis coretan
                    context.beginPath();
                    context.moveTo(lastX, lastY);
                    context.lineTo(e.offsetX, e.offsetY);
                    context.strokeStyle = 'red';
                    context.lineWidth = 2;
                    context.stroke();

                    // Simpan data coretan
                    annotations.push({
                        type: 'line',
                        startX: lastX,
                        startY: lastY,
                        endX: e.offsetX,
                        endY: e.offsetY,
                        color: 'red',
                        lineWidth: 2,
                        page: canvas.dataset.pageNumber
                    });

                    [lastX, lastY] = [e.offsetX, e.offsetY];
                });

                const canvases = [];

                // Iterasi untuk setiap halaman
                for (let pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
                    const page = await pdf.getPage(pageNumber);
                    const scale = 1.0;  // Kurangi skala untuk mengurangi ukuran gambar
                    const viewport = page.getViewport({ scale });

                    // Buat canvas untuk halaman
                    const canvas = document.createElement('canvas');
                    canvas.className = 'pdf-page w-full';
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    canvas.dataset.pageNumber = pageNumber;
                    canvasContainer.appendChild(canvas);
                    canvases.push(canvas);

                    // Render PDF ke canvas
                    const context = canvas.getContext('2d');
                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    await page.render(renderContext).promise;
                }

                addTextboxButton.addEventListener('click', () => {
                    const textbox = document.createElement('div');
                    textbox.contentEditable = "true"; // Set contentEditable to true
                    textbox.className = 'textbox';
                    textbox.style.left = '192px';
                    textbox.style.top = '50px';
                    textbox.textContent = '';

                    // Simpan referensi halaman untuk textbox ini
                    const currentPage = canvases.findIndex(canvas => canvas.getBoundingClientRect().top >= window.scrollY);
                    textbox.dataset.pageNumber = currentPage + 1;

                    canvasContainer.appendChild(textbox);
                    textbox.focus(); // Fokuskan pada textbox agar bisa langsung diketik
                    dragElement(textbox);
                });

                addImageButton.addEventListener('click', () => {
                    uploadImageInput.click();
                });

                uploadImageInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = new Image();
                            img.src = e.target.result;
                            img.className = 'draggable-image w-1/6 h-1/2';
                            img.style.left = '10px';
                            img.style.top = '10px';

                            // Simpan referensi halaman untuk gambar ini
                            const currentPage = canvases.findIndex(canvas => canvas.getBoundingClientRect().top >= window.scrollY);
                            img.dataset.pageNumber = currentPage + 1;

                            canvasContainer.appendChild(img);
                            dragElement(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Tambahkan event listener untuk resize gambar di luar event listener untuk menambahkan gambar
                // Tambahkan event listener untuk resize gambar di luar event listener untuk menambahkan gambar
                // Tambahkan event listener untuk resize gambar di luar event listener untuk menambahkan gambar
                // Tambahkan event listener untuk resize gambar di luar event listener untuk menambahkan gambar
                document.addEventListener('mousedown', function (e) {
                    const target = e.target;
                    if (target && target.classList.contains('draggable-image')) {
                        e.preventDefault();
                        const rect = target.getBoundingClientRect();
                        const offsetX = e.clientX - rect.left;
                        const offsetY = e.clientY - rect.top;
                        let prevX = e.clientX;
                        let prevY = e.clientY;
                        let prevWidth = target.offsetWidth;
                        let prevHeight = target.offsetHeight;
                        document.onmousemove = resize;
                        document.onmouseup = stopResize;

                        function resize(e) {
                            const dx = e.clientX - prevX;
                            const dy = e.clientY - prevY;

                            // Perbarui ukuran gambar
                            target.style.width = prevWidth + dx + 'px';
                            target.style.height = prevHeight + dy + 'px';

                            // Perbarui posisi gambar agar tetap di tempatnya saat diresize
                            target.style.left = (parseInt(target.style.left) + dx) + 'px';
                            target.style.top = (parseInt(target.style.top) + dy) + 'px';

                            prevX = e.clientX;
                            prevY = e.clientY;
                            prevWidth = target.offsetWidth;
                            prevHeight = target.offsetHeight;
                        }

                        function stopResize() {
                            document.onmousemove = null;
                            document.onmouseup = null;
                        }
                    }
                });

                downloadPdfButton.addEventListener('click', () => {
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF();

                    canvases.forEach((canvas, index) => {
                        if (index > 0) pdf.addPage();
                        const imgData = canvas.toDataURL('image/jpeg', 0.8); // Gunakan format JPEG dengan kualitas 0.8
                        pdf.addImage(imgData, 'JPEG', 0, 0, pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight());

                        // Add textbox contents to the PDF for this page only
                        // Add textbox contents to the PDF for this page only
                    document.querySelectorAll(`.textbox[data-page-number="${index + 1}"]`).forEach((textbox) => {
                        const text = textbox.textContent;
                        const style = window.getComputedStyle(textbox);
                        const left = parseInt(style.left) / (canvas.width / pdf.internal.pageSize.getWidth());
                        const top = (parseInt(style.top) / (canvas.height / pdf.internal.pageSize.getHeight())) + pdf.internal.getFontSize();

                        pdf.setFontSize(parseInt(style.fontSize));
                        pdf.text(text, left, top);
                    });

// Add images to the PDF for this page only
                    document.querySelectorAll(`.draggable-image[data-page-number="${index + 1}"]`).forEach((image) => {
                        const style = window.getComputedStyle(image);
                        const left = parseInt(style.left) / (canvas.width / pdf.internal.pageSize.getWidth());
                        const top = parseInt(style.top) / (canvas.height / pdf.internal.pageSize.getHeight());
                        const imgWidth = image.width / (canvas.width / pdf.internal.pageSize.getWidth());
                        const imgHeight = image.height / (canvas.height / pdf.internal.pageSize.getHeight());

                        pdf.addImage(image.src, 'JPEG', left, top, imgWidth, imgHeight);
                    });

                    });

                    pdf.save('annotated.pdf');
                });

                function dragElement(el) {
                    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
                    el.onmousedown = dragMouseDown;

                    function dragMouseDown(e) {
                        e = e || window.event;
                        e.preventDefault();
                        pos3 = e.clientX;
                        pos4 = e.clientY;
                        document.onmouseup = closeDragElement;
                        document.onmousemove = elementDrag;
                    }

                    function elementDrag(e) {
                        e = e || window.event;
                        e.preventDefault();
                        pos1 = pos3 - e.clientX;
                        pos2 = pos4 - e.clientY;
                        pos3 = e.clientX;
                        pos4 = e.clientY;
                        el.style.top = (el.offsetTop - pos2) + "px";
                        el.style.left = (el.offsetLeft - pos1) + "px";
                    }

                    function closeDragElement() {
                        document.onmouseup = null;
                        document.onmousemove = null;
                    }
                }
            } catch (error) {
                console.error('Error rendering PDF:', error);
            }
        }

        displayPDF();
    </script>

@endsection
