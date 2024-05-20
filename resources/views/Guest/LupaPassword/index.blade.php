@extends('Guest.layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-customWhite">
    <div class="w-full max-w-4xl flex bg-white rounded-lg shadow-lg overflow-hidden border border-customBlack">
        <!-- Icon Gembok -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erorr )
                    <li>
                        {{ $erorr }}
                    </li>
                @endforeach
            </ul>
        </div>
        @if (session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
        @endif
            
        @endif
        <div class="w-1/3 bg-customWhite text-customBlue flex items-center justify-center">
            <i class="fas fa-lock" style="font-size: 14rem;"></i>
        </div>

        

        <!-- Form Reset Password -->
        <div class="w-2/3 p-8">
            <h2 class="text-2xl font-bold mb-2 text-center">Reset Password</h2>
            <p class="text-sm text-gray-600 py-2">
                Untuk mengatur ulang kata sandi Anda, kirimkan alamat email Anda di bawah ini. Jika kami dapat menemukan Anda di database, sebuah email akan dikirim ke alamat email Anda, dengan instruksi bagaimana mendapatkan akses kembali.
            </p>
            <form action="{{ route('forget-password.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <input type="submit" value="Request Password Reset" class="w-full btn btn-primary bg-customBlue text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
            </form>
            
            
        </div>
    </div>
</div>
@endsection