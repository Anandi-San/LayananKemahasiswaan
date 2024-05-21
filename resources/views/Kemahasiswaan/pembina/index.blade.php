@extends('Kemahasiswaan.Components.layout')
<title>Daftar Pembina</title>

@section('content')
    <div class="flex flex-col mt-12 ml-4 md:ml-16 lg:ml-20 mr-16">
        <div class="ml-4">
            <p class="font-bold text-3xl text-customBlack">Daftar Pembina</p>
        </div>
        <div class="flex items-center bg-customWhite text-white w-full md:w-full h-16 mt-8">
            <div class="flex items-center w-full p-4">
                <label class="flex items-center bg-white rounded-lg px-4 relative border border-customBlack">
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
                </label>
                
                <div class="flex-grow"></div>
                
                <a href="{{ route('Pembina.create') }}" class="flex items-center w-36 bg-customBlack rounded-lg px-4 py-2 cursor-pointer" onclick="handleAddButton()">
                    <i class="fas fa-plus text-customWhite mr-2"></i>
                    <span class="text-customWhite font-medium">Tambah</span>
                </a>
            </div>
        </div>

        <div class="bg-customBlue w-full md:w-full shadow-md border border-customBlack overflow-x-auto">
            <div class="flex flex-row justify-between p-2 md:p-4 text-white">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Nama Pembina</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Ormawa</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Operasi</p>
            </div>
        </div>

        <div class="bg-customWhite w-full md:w-full">
            @foreach ($pembinaList as $index => $pembina)
                <div class=" bg-customWhite w-full md:w-full shadow-md border border-customBlack overflow-x-auto">
                    <div class="flex flex-row justify-between p-2 md:p-4">
                    <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $pembina->nama_pembina }}</p>
                    @foreach($pembina->ormawaPembina as $ormawa)
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $ormawa->ormawa->nama_ormawa }}</p>
                    @endforeach
                    <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $pembina->status ?? 'aktif' }}</p>
                    <p class="text-center w-1/12 text-xs md:text-lg mr-1">
                        <!-- Ganti teks "Edit" dengan ikon pensil -->
                        <a href="{{ route('edit.Pembina', $pembina->id) }}" class="mr-2" title="Edit">
                            <i class="fas fa-edit text-blue-500 ml-2"></i>
                        </a> |
                        <!-- Ganti teks "Delete" dengan ikon tong sampah -->
                        <a href="#" title="Delete">
                            <i class="fas fa-trash text-red-500 ml-2"></i>
                        </a>
                    </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('Pembina.Components.footer2')
@endsection
