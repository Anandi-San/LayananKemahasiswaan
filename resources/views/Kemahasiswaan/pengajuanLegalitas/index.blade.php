@extends('Kemahasiswaan.Components.layout')
<title>Pengajuan Legalitas</title>

@section('content')
<div class="flex flex-col items-center justify-center mt-32 ml-4 md:ml-16 lg:ml-36 mr-4">
    <!-- Bagian Header -->
    <div class="flex items-center justify-between bg-blue-500 text-white w-full md:w-full h-20 shadow-lg">
        <p class="text-base md:text-lg font-bold ml-4">Pengajuan Legalitas</p>
        <div class="flex items-center bg-white rounded-lg px-4 py-2 relative h-10 mr-4">
            <span class="absolute left-0 flex items-center justify-center w-10 h-10">
                <i class="fas fa-search text-customBlack"></i>
            </span>
            <input
                type="text"
                placeholder="Search"
                id="searchInput"
                class="rounded-lg flex-grow px-2 py-2 pl-10 focus:outline-none focus:shadow-outline text-black"
                oninput="handleSearch()"
            />
        </div>
    </div>
    <!-- Header kolom -->
<div class="bg-customWhite w-full md:w-full shadow-md border custom-black overflow-x-auto">
    <div class="bg-customWhite w-full shadow-md mt-2 border border-customBlack">
        <div class="flex flex-row justify-between p-2 md:p-4">
            <p class="text-center w-1/8 text-xs md:text-sm">#</p>
            <p class="text-center w-1/12 text-xs md:text-sm">Nama Ormawa</p>
            <p class="text-center w-1/12 text-xs md:text-sm">Proposal Legalitas</p>
            <p class="text-center w-1/12 text-xs md:text-sm">AD/ART</p>
            <p class="text-center w-1/12 text-xs md:text-sm">Surat Permohonan</p>
            <p class="text-center w-1/12 text-xs md:text-sm whitespace-normal">Daftar Nama<br>Kepengurusan</p>
            <p class="text-center w-1/12 text-xs md:text-sm whitespace-normal">Daftar Sarana<br>Prasarana</p>
            <p class="text-center w-1/12 text-xs md:text-sm">GBHK</p>
            <p class="text-center w-1/12 text-xs md:text-sm">LPJ Kepengurusan</p>
            <p class="text-center w-1/12 text-xs md:text-sm">Status</p>
            <p class="text-center w-1/12 text-xs md:text-sm">Operasi</p>
        </div>
    </div>
    <!-- Isi tabel -->
        @foreach ($data as $index => $item)
        <div class="flex flex-row justify-between p-2 md:p-4 border border-customBlack">
            <p class="text-center w-1/8 text-xs md:text-sm">{{ $index + 1 }}</p>
            <p class="text-center w-1/12 text-xs md:text-sm">{{ $item->ormawaPembina->ormawa->nama_ormawa }}</p>
            <p class="text-center w-1/12 text-xs md:text-sm">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'proposal_legalitas']) }}">
                    {{ $item->proposal_legalitas }}
                </a>
            </p>
            <p class="text-center w-1/12 text-xs md:text-sm">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'AD_ART']) }}">
                    {{ $item->AD_ART ?? 'AD/ART.pdf' }}
                </a>
            </p>
            <p class="text-center w-1/12 text-xs md:text-sm">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'surat_permohonan']) }}">
                    {{ $item->surat_permohonan }}
                </a>
            </p>
            <p class="text-center w-1/12 text-xs md:text-sm whitespace-normal">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'daftar_nama_kepengurusan']) }}">
                    daftar nama Kepengurusan
                </a>
            </p>
            <p class="text-center w-1/12 text-xs md:text-sm whitespace-normal">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'daftar_sarana_prasarana']) }}">
                    {{ $item->daftar_sarana_prasarana }}
                </a>
            </p>
            
            <p class="text-center w-1/12 text-xs md:text-sm">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'GBHK']) }}">
                    {{ $item->GBHK }}
                </a>
            </p>
            <p class="text-center w-1/12 text-xs md:text-sm">
                <a href="{{ route('edit_pengajuanpdf', ['id' => $item->id, 'type' => 'LPJ_kepengurusan']) }}">
                    {{ $item->LPJ_kepengurusan }}
                </a>
            </p>
            <p class="text-center w-1/12  text-xs md:text-sm text-customWhite ">
                <span class="rounded-lg border px-2 py-1 bg-customBlack">{{ $item->status }}</span>
            </p>
            <p class="text-center w-1/12 text-xs md:text-xl">
                <a href="#" title="Setujui">
                    <i class="fas fa-check"></i> <!-- Ikon centang -->
                </a>
                |
                <a href="#" title="Hapus">
                    <i class="fas fa-trash"></i> <!-- Ikon tong sampah -->
                </a>
            </p>
        </div>
        @endforeach
    </div>
    </div>
    @include('Ormawa.Components.footer2')
</div>
@endsection
