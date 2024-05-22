@extends('Kemahasiswaan.Components.layout')
<title>Pengajuan Legalitas</title>

@section('content')
    <div class="flex flex-col mt-10  ml-4 md:ml-16 lg:ml-20 mr-16">
        <p class="font-bold text-3xl text-customBlack">Pengajuan Legalitas</p>
        <p class="font-bold text-2xl mb-2 text-customBlack">Daftar Pengajuan Legalitas</p>
        <div class="flex items-center justify-end text-white w-full md:w-full h-16 mt-8">
            <label class="flex items-center bg-white rounded-lg px-4 py-2 relative h-10 mr-4 ml-4 border border-customBlack">
                <span class="absolute left-0 flex items-center justify-center w-10 h-10">
                    <i class="fas fa-search text-customBlack"></i>
                </span>
                <input type="text" placeholder="Search" id="searchInput"
                    class="rounded-lg flex-grow px-2 pl-10 focus:outline-none focus:shadow-outline text-black"
                    style="outline: none" oninput="handleSearch()" />
            </label>
        </div>
        <!-- Header kolom -->
        {{-- <div class="bg-customWhite w-full md:w-full shadow-md border custom-black overflow-x-auto"> --}}
        <div class="bg-customBlue w-full border border-customBlack h-16">
            <div class="flex flex-row justify-between p-3 text-customWhite items-center">
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
            <div class="flex flex-row justify-between p-2 md:p-3 border border-customBlack items-center">
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
                    <span class="rounded-lg border px-3 py-3 bg-customBlue">{{ $item->status }}</span>
                </p>
                <p class="text-center w-1/12 text-xs md:text-2xl space-x-2">
                    <a href="#" title="Setujui">
                        <i class="fas fa-check text-customBlue"></i> <!-- Ikon centang -->
                    </a>
                    <a>|</a>
                    <a href="#" title="Hapus">
                        <i class="fas fa-trash text-red-500"></i> <!-- Ikon tong sampah -->
                    </a>
                </p>
            </div>
        @endforeach
        {{-- </div> --}}
    </div>
    @include('Ormawa.Components.footer2')
    </div>
@endsection
