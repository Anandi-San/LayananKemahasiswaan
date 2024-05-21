@extends('Pembina.Components.layout')
<title>Menunggu</title>

@section('content')
    <div class="flex items-center justify-center my-8 mt-36 mx-4 ml-2 md:ml-36">
    <div class="h-40 md:h-52 w-full md:w-2/5 bg-white border border-customBlue rounded-lg shadow-xl flex flex-col items-center justify-center">
        <div class="flex justify-center items-center w-11/12 h-32 md:h-40 bg-customWhite border-dashed border-2 border-customBlack rounded-md">
            Belum Ada Proposal Kegiatan
        </div>
    </div>
</div>

@include('Ormawa.Components.footer2')

@endsection

