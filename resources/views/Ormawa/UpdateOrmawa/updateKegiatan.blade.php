@extends('Ormawa.Components.layout')

@section('content')
<div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
    <div class="flex flex-col w-11/12 justify-start mx-auto">
        <div class="flex flex-row">
            <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Update Kegiatan</p>
        </div>
        <div class="flex flex-col mr-2">
        <label for="nama-kegiatan" class="font-bold text-lg text-customBlack mb-2">Nama Kegiatan:</label>
        <h2 class="text-lg font-bold mb-4 sm:w-full border border-customBlack bg-white px-4 py-2 focus:outline-none focus:border-customBlue">{{ $proposalKegiatan->nama_kegiatan }}</h2>
    </div>


        <form action="{{route ('update.Kegiatan')}}" method="POST" class="w-full">
            @csrf
        <div class="flex flex-col sm:flex-row sm:space-x-10">
            <div class="flex flex-col mr-2 mt-4">
    <label for="jumlah-dana" class="font-bold text-lg text-customBlack mb-2">Jumlah Dana</label>
    @if (!$monitoringKegiatan->isEmpty())
        <!-- Access the properties of the first object in the array -->
        <input type="text" id="jumlah-dana" name="jumlah-dana[]" value="{{($monitoringKegiatan[0]->jumlah_dana) }}" class="sm:w-11/12 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
    @else
        <input type="text" id="jumlah-dana" name="jumlah-dana[]" value="" class="sm:w-11/12 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
    @endif
</div>
<div class="flex flex-col mr-2 mt-4">
    <label for="saldo" class="font-bold text-lg text-customBlack mb-2">Dana Tersisa:</label>
    @if (!$monitoringKegiatan->isEmpty())
        <input type="text" id="saldo" name="saldo[]" value="Rp. {{ number_format($monitoringKegiatan[0]->saldo, 2, ',', '.') }}" class="sm:w-11/12 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue" readonly>

    @else
    <input type="text" id="saldo" name="saldo[]" value="" class="sm:w-11/12 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue" readonly>

    @endif
</div>

        </div>
        {{-- @endforeach --}}
        <!-- Bagian untuk input jenis pembayaran -->
        
        <div id="payment-container" class="flex flex-col mt-4">
        <label class="font-bold text-lg text-customBlack mb-2">Pembayaran:</label>
        @if (!empty($keteranganPembayaran))
            @foreach ($keteranganPembayaran as $keteranganKey => $keterangan)
                @foreach ($keterangan as $kegiatanPembayaran)
                    <div class="flex sm:flex-row space-x-4" id="payment-box-{{ $kegiatanPembayaran->id }}">
                        <input type="text" name="jenis-pembayaran[]" value="{{ $kegiatanPembayaran->jenis_pembayaran }}" placeholder="Jenis Pembayaran" class="sm:w-1/2 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue">
                        <input type="number" name="jumlah-pembayaran[]" value="{{ $kegiatanPembayaran->jumlah_pembayaran }}" placeholder="Jumlah Pembayaran (Rp)" class="sm:w-1/2 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue">
                        <input type="date" name="tanggal-pembayaran[]" value="{{ $kegiatanPembayaran->tanggal_pembayaran }}" placeholder="Tanggal Pembayaran" class="sm:w-1/2 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue">
                    </div>
                @endforeach
            @endforeach
        @endif


            {{-- @endif --}}
            
            <!-- Tombol ikon tambah -->
            <button type="button" id="add-payment-button" class="mt-4 bg-customBlue text-white font-bold py-2 px-4 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span class="ml-2">Tambah Pembayaran</span>
            </button>
        </div>
        <div class="flex flex-row items-center mt-4 sm:mt-8">
            @if(!$monitoringKegiatan->isEmpty())
                <input type="checkbox" id="kegiatan-berhasil" name="kegiatan-status" value="berhasil" class="mr-2 h-6 w-6" {{ $monitoringKegiatan[0]->parameter_keberhasilan === 'berhasil' ? 'checked' : '' }}>
                <label for="kegiatan-berhasil" class="text-customBlack">Kegiatan Berhasil</label>
                <input type="checkbox" id="kegiatan-tidak-berhasil" name="kegiatan-status" value="tidak berhasil" class="ml-4 mr-2 h-6 w-6" {{ $monitoringKegiatan[0]->parameter_keberhasilan === 'tidak berhasil' ? 'checked' : '' }}>
                <label for="kegiatan-tidak-berhasil" class="text-customBlack">Kegiatan Tidak Berhasil</label>
            @else
                <input type="checkbox" id="kegiatan-berhasil" name="kegiatan-status" value="berhasil" class="mr-2 h-6 w-6">
                <label for="kegiatan-berhasil" class="text-customBlack">Kegiatan Berhasil</label>
                <input type="checkbox" id="kegiatan-tidak-berhasil" name="kegiatan-status" value="tidak berhasil" class="ml-4 mr-2 h-6 w-6">
                <label for="kegiatan-tidak-berhasil" class="text-customBlack">Kegiatan Tidak Berhasil</label>
            @endif
        </div>
        
        
        <div class="flex flex-col h-1/2 mt-4 mr-2">
            <label for="catatan" class="mt-2 font-bold text-lg text-customBlack mb-2">Catatan:</label>
            <textarea id="catatan" placeholder="Catatan" name="catatan" class="sm:w-full h-60 sm:h-96 border border-gray-300 px-4 py-2 focus:outline-none focus:border-customBlue resize-y">{{ isset($monitoringKegiatan[0]->catatan) ? $monitoringKegiatan[0]->catatan : '' }}</textarea>
        </div>
        @if(!$monitoringKegiatan->isEmpty())
        <input type="hidden" name="id_monitoring_kegiatan" value="{{ $monitoringKegiatan[0]->id }}">
        <input type="hidden" name="id_ormawa" value="{{ $monitoringKegiatan[0]->id_ormawa }}">
    @else
        @if($monitoringKegiatan->count() > 0)
            <input type="hidden" name="id_monitoring_kegiatan" value="{{ $monitoringKegiatan[0]->id }}">
            <input type="hidden" name="id_ormawa" value="{{ $monitoringKegiatan[0]->id_ormawa }}">
        @else
            <input type="hidden" name="id_monitoring_kegiatan" value="">
            <input type="hidden" name="id_ormawa" value="{{ $ormawa->id }}">
        @endif
    @endif
        <input type="hidden" name="id_proposal_kegiatan" value={{$proposalKegiatan->id}}>
        <div class="flex py-4">
            <button type="submit" class="sm:w-1/3 w-full bg-customBlue text-white font-bold py-4 px-4 rounded-lg">Simpan</button>
        </div>
    </div>
    </form>

</div>

@include('Ormawa.Components.footer')
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addPaymentButton = document.getElementById('add-payment-button');
    const paymentContainer = document.getElementById('payment-container');
    let paymentBoxCount = 1; // Penghitung box pembayaran

    // Fungsi untuk menambahkan box pembayaran baru
    const addPaymentBox = () => {
        paymentBoxCount++; // Menambah jumlah box pembayaran

        // Membuat div untuk input box baru
        const paymentBox = document.createElement('div');
        paymentBox.classList.add('flex', 'sm:flex-row', 'space-x-4', 'mt-4');
        paymentBox.id = `payment-box-${paymentBoxCount}`;

        // Menambahkan input untuk jenis pembayaran
        const jenisPembayaranInput = document.createElement('input');
        jenisPembayaranInput.type = 'text';
        jenisPembayaranInput.name = `jenis-pembayaran[]`;
        jenisPembayaranInput.placeholder = 'Jenis Pembayaran';
        jenisPembayaranInput.classList.add('sm:w-1/2', 'border', 'border-gray-300', 'px-4', 'py-2', 'focus:outline-none', 'focus:border-customBlue');

        // Menambahkan input untuk jumlah pembayaran
        const jumlahPembayaranInput = document.createElement('input');
        jumlahPembayaranInput.type = 'number';
        jumlahPembayaranInput.name = `jumlah-pembayaran[]`;
        jumlahPembayaranInput.placeholder = 'Jumlah Pembayaran (Rp)';
        jumlahPembayaranInput.classList.add('sm:w-1/2', 'border', 'border-gray-300', 'px-4', 'py-2', 'focus:outline-none', 'focus:border-customBlue');

        // Menambahkan input untuk tanggal pembayaran
        const tanggalPembayaranInput = document.createElement('input');
        tanggalPembayaranInput.type = 'date';
        tanggalPembayaranInput.name = `tanggal-pembayaran[]`;
        tanggalPembayaranInput.placeholder = 'Tanggal Pembayaran';
        tanggalPembayaranInput.classList.add('sm:w-1/2', 'border', 'border-gray-300', 'px-4', 'py-2', 'focus:outline-none', 'focus:border-customBlue');

        // Menambahkan input box ke dalam div pembayaran
        paymentBox.appendChild(jenisPembayaranInput);
        paymentBox.appendChild(jumlahPembayaranInput);
        paymentBox.appendChild(tanggalPembayaranInput);

        // Menambahkan div pembayaran ke dalam container
        paymentContainer.appendChild(paymentBox);

        // Pastikan tombol tambah pembayaran tetap di bawah
        paymentContainer.appendChild(addPaymentButton);
    };

    // Menambahkan event listener untuk menambahkan input box baru ketika tombol tambah diklik
    addPaymentButton.addEventListener('click', function() {
        addPaymentBox();
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="kegiatan-status"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                if (cb !== this) {
                    cb.checked = false;
                }
            });
        });
    });
});

</script>