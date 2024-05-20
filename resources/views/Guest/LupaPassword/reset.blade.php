@extends('Guest.layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-customWhite">
    <div class="w-full max-w-4xl flex bg-white rounded-lg shadow-lg overflow-hidden border border-customBlack">
        <div class="w-1/3 bg-customWhite text-customBlue flex items-center justify-center">
            <i class="fas fa-lock" style="font-size: 14rem;"></i>
        </div>

        <!-- Form Reset Password -->
        <div class="w-2/3 p-8">
            <h2 class="text-2xl font-bold mb-2 text-center">Reset Password</h2>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <input type="hidden" name="email" value="{{ $email }}">

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <button type="submit" class="w-full btn btn-primary bg-customBlue text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Reset Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
