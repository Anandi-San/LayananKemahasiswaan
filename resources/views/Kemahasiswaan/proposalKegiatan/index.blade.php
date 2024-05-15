@extends('Kemahasiswaan.Components.layout')
<title>Proposal Kegiatan</title>

@section('content')
<div class="flex flex-col items-center justify-center mt-32 ml-4 md:ml-16 lg:ml-36 mr-4">
    <div class="flex items-center justify-between bg-blue-500 text-white w-full md:w-full h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Proposal Kegiatan</p>
        <div class="flex items-center bg-white rounded-lg px-4 py-2 relative h-12 mr-4">
            <span class="absolute left-0 flex items-center justify-center w-12 h-12">
                <i class="fas fa-search text-customBlack"></i>
            </span>
            <input
                type="text"
                placeholder="Search"
                id="searchInput"
                class="rounded-lg flex-grow px-2 py-2 pl-12 focus:outline-none focus:shadow-outline text-black"
                oninput="handleSearch()"
            />
        </div>
    </div>

    <!-- Header kolom -->
    <div class="bg-customWhite w-full shadow-md mt-2 border border-customBlack overflow-x-auto">
        <div class="flex flex-row justify-between p-2 md:p-4">
            <p class="text-center w-1/8  text-xs md:text-sm">#</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Nama Ormawa</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Sampul Depan</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Lampiran 1</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Lampiran 2</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Lampiran 3</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Sampul Belakang</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Lainnya</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Status</p>
            <p class="text-center w-1/12  text-xs md:text-sm">Operasi</p>
        </div>
    </div>

    <!-- Isi tabel -->
    <div class="bg-customWhite w-full shadow-md border border-customBlack overflow-x-auto">
        @foreach ($proposal_kegiatan as $index => $item)
        <div class="flex flex-row justify-between p-2 md:p-4 border-b border-customBlack">
            <p class="text-center w-1/8  text-xs md:text-sm">{{ $index + 1 }}</p>
            <p class="text-center w-1/12  text-xs md:text-sm">{{ $item->skLegalitas->pengajuanLegalitas->ormawaPembina->ormawa->nama_ormawa }}</p>
            <p class="text-center w-1/12  text-xs md:text-sm">
                <a href="{{ route('edit_proposalpdf', ['id' => $item->id, 'type' => 'sampul_depan']) }}">
                    {{ $item->sampul_depan }}
                </a>
            </p>
            <p class="text-center w-1/12  text-xs md:text-sm">
                <a href="{{ route('edit_proposalpdf', ['id' => $item->id, 'type' => 'lampiran1']) }}">
                    {{ $item->lampiran1 }}
                </a>
            </p>
            <p class="text-center w-1/12  text-xs md:text-sm">
                <a href="{{ route('edit_proposalpdf', ['id' => $item->id, 'type' => 'lampiran2']) }}">
                    {{ $item->lampiran2 }}
                </a>
            </p>
            <p class="text-center w-1/12  text-xs md:text-sm">
                <a href="{{ route('edit_proposalpdf', ['id' => $item->id, 'type' => 'lampiran3']) }}">
                    {{ $item->lampiran3 }}
                </a>
            </p>
            <p class="text-center w-1/12  text-xs md:text-sm">
                <a href="{{ route('edit_proposalpdf', ['id' => $item->id, 'type' => 'sampul_belakang']) }}">
                    {{ $item->sampul_belakang }}
                </a>
            </p>
            <p class="text-center w-1/12  text-xs md:text-sm">Lainnya</p>
            <p class="text-center w-1/12  text-xs md:text-sm text-customWhite ">
                <span class="rounded-lg border px-2 py-1 bg-customBlack">{{ $item->status }}</span>
            </p>
            <p class="text-center w-1/12  text-xs md:text-2xl">
                <a href="#" title="Edit">
                    <i class="fas fa-edit"></i> <!-- Ikon pensil untuk mengedit -->
                </a>
                |
                <a href="#" title="Delete">
                    <i class="fas fa-trash"></i> <!-- Ikon tong sampah untuk menghapus -->
                </a>
            </p>
        </div>
        @endforeach
    </div>

    @include('Ormawa.Components.footer2')
</div>
@endsection
