@extends('Kemahasiswaan.Components.layout')
<title>Edit Pengajuan Legalitas</title>

@section('content')
<div class="flex flex-col items-center">
    <div class="bg-customBlack h-16 w-full flex items-center justify-center">
        <p class="text-white text-center text-lg md:text-2xl">SK Legalitas</p>
    </div>
    
    <div class="flex justify-center w-screen mt-4">
        <div class="bg-customGray h-screen w-4/6 ml-6 flex justify-center items-center">
            <!-- Elemen canvas untuk PDF -->
            <canvas id="pdfCanvas"></canvas>
        </div>
        
        <div class="bg-customGray h-screen w-1/6 flex flex-col justify-center">
            <!-- Tombol Download -->
            <button class="bg-customBlue text-white font-bold py-3 px-6 rounded mb-4 text-sm" id="downloadButton">Download</button>
        </div>
    </div>
</div>

<script>
    // Mendapatkan elemen canvas
    const canvas = document.getElementById('pdfCanvas');
    const context = canvas.getContext('2d');

    // URL file PDF
    const pdfUrl = '{{ Storage::url("legalitas/" . $pdfFile) }}';

    // Fungsi untuk menampilkan PDF menggunakan pdf-lib.js
    async function displayPdf() {
        // Memuat PDF dari URL
        const response = await fetch(pdfUrl);
        const arrayBuffer = await response.arrayBuffer();
        
        // Buat PDFDocument
        const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);

        // Ambil halaman pertama
        const page = pdfDoc.getPages()[0];
        
        // Dapatkan dimensi halaman
        const { width, height } = page.getSize();
        
        // Sesuaikan ukuran canvas
        canvas.width = width;
        canvas.height = height;
        
        // Render halaman PDF di canvas
        const imageData = await page.render({
            canvasContext: context,
            viewport: page.getViewport({ scale: 1 })
        });
    }

    // Panggil fungsi untuk menampilkan PDF saat halaman dimuat
    displayPdf();

    // Fungsi untuk mengunduh PDF
    document.getElementById('downloadButton').addEventListener('click', async () => {
        const pdfDoc = await PDFLib.PDFDocument.create();
        
        // Tambahkan halaman baru
        const page = pdfDoc.addPage();
        
        // Ambil gambar dari canvas
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        
        // Tambahkan gambar ke halaman
        const image = await pdfDoc.embedPng(imageData);
        const { width, height } = image.scale(1);
        page.drawImage(image, { x: 0, y: height, width, height });
        
        // Simpan PDF dan unduh
        const pdfBytes = await pdfDoc.save();
        const blob = new Blob([pdfBytes], { type: 'application/pdf' });
        const url = URL.createObjectURL(blob);
        
        const link = document.createElement('a');
        link.href = url;
        link.download = '{{ $pdfFile }}';
        link.click();
        
        // Hapus URL objek untuk membersihkan sumber daya
        URL.revokeObjectURL(url);
    });
</script>
@endsection
