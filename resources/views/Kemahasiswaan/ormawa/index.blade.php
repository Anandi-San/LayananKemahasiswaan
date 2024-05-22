@extends('Kemahasiswaan.Components.layout')
<title>Daftar Ormawa</title>

@section('content')
    <div class="flex flex-col mt-16 ml-4 md:ml-16 lg:ml-16 mr-20">
        <div class="ml-4">
            <p class="font-bold text-3xl text-customBlack">Daftar Ormawa</p>
        </div>
        <div class="items-start justify-start w-full">
        </div>
        <div class="flex items-center bg-customWhite text-white w-full md:w-full h-16 mt-8">
            <div class="flex items-center w-full p-4">
                <label class="flex items-center  bg-white rounded-lg px-4 py-2 relative border border-customBlack">
                    <span class="absolute left-0 flex items-center justify-center w-10 h-10">
                        <i class="fas fa-search text-customBlack"></i>
                    </span>
                    <input type="text" placeholder="Search" id="searchInput"
                        class="rounded-lg flex-grow px-2 pl-10 focus:outline-none focus:shadow-outline text-black"
                        oninput="handleSearch()" />
                </label>


                <!-- Spacer between search box and add button -->
                <div class="flex-grow"></div>

                <!-- Add button container -->
                <a href="{{ route('editOrmawa.create') }}"
                    class="flex items-center w-36 bg-green-500 rounded-lg px-4 py-2 cursor-pointer text-customWhite font-medium no-underline">
                    <i class="fas fa-plus text-customWhite mr-2"></i>
                    <span>Tambah</span>
                </a>


            </div>
        </div>

        {{-- // container hasil --}}
        <div id="searchResults" class=""></div>
        <div class="bg-customBlue w-full md:w-full shadow-md border border-customBlack h-16 flex items-center">
            <div class="flex flex-row justify-between p-3 text-white w-full items-center">
                <p class="text-center w-1/8 text-xs md:text-sm mr-1">#</p>
                <p class="text-center w-1/6 text-xs md:text-sm mr-1">Nama Ormawa</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Pembina</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Lainnya</p>
                <p class="text-center w-1/12 text-xs md:text-sm mr-1">Status</p>
                <p class="text-center w-1/6 text-xs md:text-sm mr-1">Operasi</p>
            </div>
        </div>
        <div class="bg-customWhite w-full md:w-full ">
            @foreach ($ormawaList as $index => $ormawa)
                <!-- Kotak terpisah untuk setiap item ormawa -->
                <div class="bg-customWhite w-full md:w-full shadow-md border border-customBlack overflow-x-auto">
                    <div class="flex flex-row justify-between p-3 items-center h-16"> <!-- Menetapkan tinggi konsisten -->
                        <p class="text-center w-1/8 text-xs md:text-sm mr-1">{{ $index + 1 }}</p>
                        <p class="text-center w-1/6 text-xs md:text-sm mr-1">{{ $ormawa->nama_ormawa }}</p>
                        @foreach ($ormawa->ormawaPembina as $pembina)
                            <p class="text-center w-1/12 text-xs md:text-sm mr-1">
                                {{ $pembina->pembina->nama_pembina ?? 'pembina' }}</p>
                        @endforeach
                        <p class="text-center w-1/12 text-xs md:text-sm mr-1">{{ $ormawa->lainnya ?? 'Lainnya' }}</p>
                        <p class="text-center w-1/12  text-xs md:text-sm text-customWhite">
                            <span class="rounded-lg border px-3 py-3 bg-customBlue">{{ $ormawa->status ?? 'aktif' }}</span></p>
                        <div class="text-center w-1/6 text-xs md:text-lg mr-1 flex items-center justify-center space-x-2">
                            <!-- Tautan untuk mengedit dengan ikon pensil -->
                            <a href="#" title="List" class="text-blue-500">
                                <i class="fas fa-users"></i>
                            </a> <a href="">|</a>
                            <a href="{{ route('edit.Ormawa', $ormawa->id) }}" title="Edit" class="text-yellow-500">
                                <i class="fas fa-edit"></i>
                            </a> <a href="">|</a>
                            <!-- Form untuk menghapus dengan ikon tong sampah -->
                            <form method="POST" action="{{ route('destroy.Ormawa', $ormawa->id) }}"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Ormawa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete"
                                    class="bg-transparent border-none cursor-pointer text-red-500">
                                    <i class="fas fa-trash mt-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>



    @include('Ormawa.Components.footer2')
@endsection
