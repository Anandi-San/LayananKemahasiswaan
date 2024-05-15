@extends('Ormawa.Components.layout')

@section('content')
<form id="updateKepengerusan" action="{{ route('update.Kepengurusan') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="sm:ml-36 ml-2 sm:mt-10 mt-2 ">
    <div class="flex flex-col w-11/12 justify-start mx-auto">
        <p class="font-bold text-xl pb-4 text-customBlack ml-6">Poto Profil</p>
        <div class="flex flex-row items-center justify-start w-11/12">
            <div class="w-28 md:w-40 h-28 md:h-40 rounded-full bg-gray-300 mb-4 ">
                {{-- Tampilkan logo jika ada --}}
                @if ($pengurusOrmawa->logo_kabinet)
                <img src="{{ asset($pengurusOrmawa->logo_kabinet) }}" alt="Logo Ormawa" class="w-full h-full object-cover rounded-full">
                @else
                    {{-- Logo default jika tidak ada --}}
                @endif
            </div>
            <div class="flex flex-col ml-4">
                <label for="logo_kabinet" class="bg-customBlue text-white w-52 font-bold py-2 px-4 mr-2 mb-2 rounded-lg cursor-pointer">Unggah Gambar Baru</label>
                <input type="file" id="logo_kabinet" name="logo_kabinet" accept="image/*" class="hidden">
                <button type="submit" name="action" value="delete" id="hapusGambarBtn" class="bg-customWhite text-black w-52 border border-red-600 font-bold py-2 px-4 mt-2 rounded-lg">Hapus Gambar</button>
            </div>
        </div>

        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="nama_kabinet" class="font-bold text-xl pb-2 text-customBlack">Nama Kabinet</label>
                <input type="text" id="nama_kabinet" name="nama_kabinet" value="{{ $pengurusOrmawa->nama_kabinet }}" placeholder="Masukkan Nama Kabinet" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="ketua_ormawa" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Ketua Ormawa</label>
                <input type="text" id="ketua_ormawa" name="ketua_ormawa" value="{{ $pengurusOrmawa->ketua_ormawa }}" placeholder="Masukkan Nama Ketua Ormawa" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue">
            </div>
        </div>

        <div class="mt-4 flex flex-col md:flex-row h-auto md:h-14 w-11/12 mb-8 space-x-0 md:space-x-10">
            <div class="flex flex-col md:w-1/2">
                <label for="kabinet_massa_mulai" class="font-bold text-xl pb-2 text-customBlack">Masa Mulai Kabinet</label>
                <input type="text" id="kabinet_massa_mulai" name="kabinet_massa_mulai" value="{{ $pengurusOrmawa->kabinet_masa_mulai }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
            <div class="flex flex-col md:w-1/2 mt-4 md:mt-0">
                <label for="kabinet_masa_selesai" class="font-bold text-xl pb-2 pt-2 md:pt-0 text-customBlack">Masa Selesai Kabinet</label>
                <input type="text" id="kabinet_masa_selesai" name="kabinet_masa_selesai" value="{{ $pengurusOrmawa->kabinet_masa_selesai }}" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue" readonly>
            </div>
        </div>

        <div class="mt-4 flex flex-col h-96 w-11/12">
            <label for="visi" class="font-bold text-xl pb-2 text-customBlack">Visi</label>
            <textarea id="visi" name="visi" placeholder="Masukkan Visi Ormawa" class="h-32 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue resize-none">{{ $pengurusOrmawa->visi }}</textarea>
            
            <label for="misi" class="font-bold text-xl pb-2 pt-2 text-customBlack">Misi</label>
            <textarea id="misi" name="misi" placeholder="Masukkan Misi Ormawa" class="h-64 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-customBlue resize-none">{{ $pengurusOrmawa->misi }}</textarea>
        </div>
        
        <div class="flex py-4">
            <button type="submit" class="sm:w-52 w-full bg-customBlue text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
        </div>
    </div>
</div>
</form>

@include('Ormawa.Components.footer')
@endsection
<script>
    document.getElementById('hapusGambarBtn').addEventListener('click', function(event) {
        const form = document.getElementById('updateKepengerusan');
        form.action = "{{ route('update.Kepengurusan') }}";
        form.method = 'POST';
        form.submit();
    });
    </script>
