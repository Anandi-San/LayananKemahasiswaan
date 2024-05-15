<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuka File PDF Lokal</title>
</head>

<body>
    <!-- Tambahkan tombol untuk mengaktifkan/menonaktifkan mode mencoret -->
    <button id="toggle-draw">Aktifkan Coretan</button>

    <div id="pdf-viewer">
        <canvas id="pdf-render"></canvas>
    </div>

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

                // Buat variabel untuk menyimpan data coretan
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

                    // Render PDF ke canvas
                    const context = canvas.getContext('2d');
                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    await page.render(renderContext).promise;
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
