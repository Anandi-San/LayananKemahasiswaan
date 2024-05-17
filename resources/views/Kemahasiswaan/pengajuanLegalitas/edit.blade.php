<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuka File PDF Lokal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .textbox {
            position: absolute;
            border: 1px solid #ccc;
            background-color: white;
            padding: 5px;
            resize: both;
            overflow: auto;
            min-width: 50px;
            min-height: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 p-4">

    <!-- Tambahkan tombol untuk mengaktifkan/menonaktifkan mode mencoret -->
    <button id="toggle-draw" class="bg-blue-500 text-white px-4 py-2 rounded">Aktifkan Coretan</button>
    <button id="add-textbox" class="bg-green-500 text-white px-4 py-2 rounded">Tambahkan Textbox</button>
    <button id="download-pdf" class="bg-red-500 text-white px-4 py-2 rounded">Download PDF</button>

    <div id="pdf-viewer" class="relative mt-4">
        <canvas id="pdf-render"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="{{ asset('pdfjs/build/pdf.mjs') }}" type="module"></script>
    <script type="module">
        var {
            pdfjsLib
        } = globalThis;

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
                        [lastX, lastY] = [e.offsetX, e.offsetY];
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
                        lineWidth: 2
                    });

                    [lastX, lastY] = [e.offsetX, e.offsetY];
                });

                const canvases = [];

                // Iterasi untuk setiap halaman
                for (let pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
                    const page = await pdf.getPage(pageNumber);
                    const scale = 1.5;
                    const viewport = page.getViewport({
                        scale
                    });

                    // Buat canvas untuk halaman
                    const canvas = document.createElement('canvas');
                    canvas.className = 'pdf-page';
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
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
                    textbox.style.left = '10px';
                    textbox.style.top = '10px';
                    textbox.textContent = 'Tulis sesuatu...';
                    canvasContainer.appendChild(textbox);
                    dragElement(textbox);
                });

                downloadPdfButton.addEventListener('click', () => {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const pdf = new jsPDF();

                    canvases.forEach((canvas, index) => {
                        if (index > 0) pdf.addPage();
                        const imgData = canvas.toDataURL('image/png');
                        pdf.addImage(imgData, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(), pdf
                            .internal.pageSize.getHeight());
                    });

                    document.querySelectorAll('.textbox').forEach((textbox) => {
                        const text = textbox.textContent;
                        const style = window.getComputedStyle(textbox);
                        const left = parseInt(style.left);
                        const top = parseInt(style.top);
                        const fontSize = parseInt(style.fontSize);

                        pdf.setFontSize(fontSize);
                        pdf.text(text, left, top +
                        fontSize); // Adjusting the position to consider font size
                    });

                    pdf.save('annotated.pdf');
                });

                function dragElement(el) {
                    let pos1 = 0,
                        pos2 = 0,
                        pos3 = 0,
                        pos4 = 0;
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

                // TODO: Simpan data coretan dan kirim ke server (opsional)
                console.log(annotations);
            } catch (error) {
                console.error('Error rendering PDF:', error);
            }
        }

        displayPDF();
    </script>

</body>

</html>
