@extends('Pembina.Components.layout')
<title>Pembina</title>

@section('content')
    <div class="ml-36 mb-8">
        @foreach ($data as $item)
            <p class="font-bold text-3xl text-customBlack mt-12">Halo, Pembina</p>
            <p class="font-bold text-2xl pb-6 text-customBlack">Selamat datang di halaman dashboard Pembina</p>

            @if (isset($item['monitoring_kegiatan']) && $item['monitoring_kegiatan']->isNotEmpty())
                <!-- Ambil data pertama dari jumlah_dana -->
                @php
                    $firstJumlahDana = $item['monitoring_kegiatan']->first()->jumlah_dana;
                @endphp

                <!-- Ambil jumlah total dari saldo -->
                @php
                    $totalSaldo = $item['monitoring_kegiatan']->sum('saldo');
                @endphp

                <div class="flex justify-between mr-24 mb-16 mt-8">
                    <!-- Tampilkan saldo -->
                    <a href="#"
                        class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg mr-24 h-44 w-96 justify-center">
                        <i class="fa-solid fa-money-bill-1 fa-4x mr-2 mb-1 text-customBlue"></i>
                        <p class="text-xl text-customBlack mb-1 font-semibold">RP.
                            {{ number_format($firstJumlahDana, 2, ',', '.') }}</p>
                        <p class="text-customBlue">Jumlah dana</p>
                    </a>
                    <!-- Tampilkan dana terpakai -->
                    <a href="#"
                        class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg mr-24 h-44 w-96 justify-center">
                        <i class="fa-solid fa-arrow-up fa-4x mr-2 mb-1 text-customBlue "></i>
                        <p class="text-xl text-customBlack font-semibold mb-1">RP.
                            {{ number_format($totalSaldo, 2, ',', '.') }}</p>
                        <p class="text-customBlue">Saldo</p>
                    </a>
                    <!-- Tampilkan jumlah kegiatan -->
                    <a href="#"
                        class="flex flex-col bg-customWhite border border-gray-400 p-2 rounded-lg h-44 w-96 justify-center">
                        <i class="fa-solid fa-chart-line fa-4x mr-2 mb-1 text-customblue"></i>
                        <p class="text-customBlack text-xl font-semibold mb-1">{{ $item['monitoring_kegiatan']->count() }}
                        </p>
                        <p class="text-customBlue">Jumlah Kegiatan</p>
                    </a>
                </div>
            @endif

            <div class="flex items-center mb-4">
                <i class="fa-solid fa-clock-rotate-left mr-2 text-customBlack"></i>
                <p class="text-customBlack text-xl mr-2">History</p>

                <div class="relative inline-block text-left">
                    <select id="menu-button"
                        class="inline-flex w-96 justify-end gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-customBlack shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <option disabled selected>Pilih Proposal Kegiatan</option>
                        @foreach ($data as $item)
                            @foreach ($item['proposal_kegiatan'] as $proposal)
                                <option value="{{ $proposal->id }}">{{ $proposal->nama_kegiatan }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Tampilkan data monitoring kegiatan dan keterangan pembayaran -->
            <div class="p-6 bg-customWhite border border-gray-400 rounded-lg mr-24 h-48 flex flex-col" id="dataContainer" style="overflow-y: auto;">
                <!-- Data akan dimasukkan di sini -->
            </div>
        @endforeach
    </div>
    @include('Pembina.Components.footer2')

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            var menuButton = document.getElementById('menu-button');
            var dropdownMenu = document.getElementById('dropdown-menu');

            menuButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            menuButton.addEventListener('change', async function() {
                var selectedOption = this.options[this.selectedIndex];
                var id = selectedOption.value;

                try {
                    // Lakukan fetch ke route yang disediakan
                    // Lakukan fetch ke route yang disediakan
                    var response = await fetch('/pembina/get-proposal-kegiatan/' + id);

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    var data = await response.json();

                    if (data.status === 'success') {
                        updateView(data.data);
                    } else {
                        console.error(data.message);
                    }
                } catch (error) {
                    console.error('There has been a problem with your fetch operation:', error
                        .message);
                }
            });

            document.addEventListener('click', function(event) {
                if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });

        function createPaymentElement(jenisPembayaran, jumlahPembayaran, tanggalPembayaran) {
            var paymentElement = document.createElement('div');
            paymentElement.classList.add('flex', 'items-center', 'mt-2');

            var checkIcon = document.createElement('i');
            checkIcon.classList.add('fa-solid', 'fa-circle-check', 'fa-2x', 'text-customBlue', 'mr-4');

            var textDiv = document.createElement('div');
            textDiv.classList.add('flex', 'flex-row', 'justify-between', 'w-full', 'mr-24');

            var jenisPembayaranText = document.createElement('p');
            jenisPembayaranText.classList.add('text-customBlack');
            jenisPembayaranText.textContent = jenisPembayaran;

            var jumlahPembayaranText = document.createElement('p');
            jumlahPembayaranText.classList.add('text-customBlack');
            jumlahPembayaranText.textContent = 'Rp. ' + jumlahPembayaran;

            var tanggalPembayaranText = document.createElement('p');
            tanggalPembayaranText.classList.add('text-customBlack');
            tanggalPembayaranText.textContent = tanggalPembayaran;

            textDiv.appendChild(jenisPembayaranText);
            textDiv.appendChild(jumlahPembayaranText);
            textDiv.appendChild(tanggalPembayaranText);

            paymentElement.appendChild(checkIcon);
            paymentElement.appendChild(textDiv);

            return paymentElement;
        }


        function updateView(data) {
            var keteranganPembayaranPlaceholder = document.getElementById('dataContainer');

            // Kosongkan dan sembunyikan placeholder keterangan pembayaran
            keteranganPembayaranPlaceholder.innerHTML = '';
            keteranganPembayaranPlaceholder.style.display = 'none';

            // Tampilkan keterangan pembayaran
            if (data.monitoring_kegiatan.length > 0) {
                var keteranganPembayaran = data.monitoring_kegiatan[0].keterangan_pembayaran;

                keteranganPembayaran.forEach(function(keterangan) {
                    var paymentElement = createPaymentElement(keterangan.jenis_pembayaran, keterangan
                        .jumlah_pembayaran, keterangan.tanggal_pembayaran);
                    keteranganPembayaranPlaceholder.appendChild(paymentElement);
                });

                keteranganPembayaranPlaceholder.style.display = 'block';
            }
        }
    </script>
