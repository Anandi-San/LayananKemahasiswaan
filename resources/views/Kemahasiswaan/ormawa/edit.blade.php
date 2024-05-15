@extends('Kemahasiswaan.Components.layout')

@section('content')
<form id="ormawaForm" action="{{ route('update.Ormawa', ['id' => $ormawa->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id_ormawa" value="{{ $ormawa->id }}">
    <div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
        <div class="flex flex-col">
            <div class="flex flex-col w-11/12 justify-start mx-auto">
                <p class="font-bold text-xl pb-2 md:pb-4 text-customBlack">Update Detail Data Ormawa</p>
                <p class="font-bold text-xl pb-4 text-customBlack">Foto Profil</p>
            </div>
            <div class="flex flex-row items-center justify-start mx-auto w-11/12">
                <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4 relative">
                    @if($ormawa->logo_ormawa)
                        <img src="{{ asset($ormawa->logo_ormawa) }}" class="absolute inset-0 w-full h-full object-cover rounded-full">
                    @endif
                </div>
                <div class="flex flex-col ml-4">
                    <label for="logo_ormawa" class="bg-customBlue text-white w-52 font-bold py-2 px-4 mr-2 mb-2 rounded-lg cursor-pointer">Unggah Gambar Baru</label>
                    <input type="file" id="logo_ormawa" name="logo_ormawa" accept="image/*" class="hidden">
                    <button type="submit" name="action" value="delete" id="hapusGambarBtn" class="bg-customWhite text-black w-52 border border-red-600 font-bold py-2 px-4 mt-2 rounded-lg">Hapus Gambar</button>
                </div>
            </div>
        </div>

        <!-- Form isian Ormawa -->
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="nama_ormawa" class="font-bold text-xl pb-2 text-customBlack">Nama Ormawa</label>
                <input type="text" id="nama_ormawa" name="nama_ormawa" value="{{ $ormawa->nama_ormawa }}" placeholder="Masukkan Nama Ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="singkatan_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Singkatan</label>
                <input type="text" id="singkatan_ormawa" name="singkatan_ormawa" value="{{ $ormawa->singkatan }}" placeholder="Masukkan Singkatan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>

        <!-- Isian lainnya -->
        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="jenis_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jenis Ormawa</label>
                <input type="text" id="jenis_ormawa" name="jenis_ormawa" value="{{ $ormawa->jenis_ormawa }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="jurusan" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="{{ $ormawa->jurusan }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
        </div>

<!-- Tampilkan data jumlah_dana -->
<div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mx-auto mb-8 space-x-0 md:space-x-10">
    <div class="flex flex-col md:w-1/2">
        <label for="jumlah_dana" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Dana yang Diberikan</label>
        <input type="text" id="jumlah_dana" name="jumlah_dana" value="Rp {{ $monitoringKegiatan->jumlah_dana ?? '' }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" oninput="formatRupiah(this)" required>
    </div>
    <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
    </div>
</div>


        <!-- Tombol -->
        <div class="mt-4 flex flex-row mb-8 w-11/12 mx-auto">
            <!-- Button Tambahan -->
            <a href="#" class="sm:w-64 w-full bg-gray-500 text-white font-bold py-2 px-4 rounded-lg text-center mr-6">List Pengurus Ormawa</a>

            <!-- Button Simpan -->
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
        </div>
    </div>
</form>

@include('Ormawa.Components.footer2')

@endsection

<script>
    document.getElementById('hapusGambarBtn').addEventListener('click', function(event) {
        event.preventDefault();
        const form = document.getElementById('ormawaForm');
        form.action = "{{ route('ormawa.update.ormawa') }}";
        form.method = 'POST';
        form.submit();
    });

    function formatRupiah(input) {
        var value = input.value.replace(/[^,\d]/g, '');
        var numberString = value.replace(/[^,\d]/g, '').toString();
        var split = numberString.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }
</script>
