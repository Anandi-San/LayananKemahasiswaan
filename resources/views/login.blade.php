<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login</title>
</head>
<body class="flex h-screen bg-fixed bg-left bg-no-repeat bg-cover" style="background-image: url('/images/background.png');">
    <div class="flex-grow flex justify-end items-center h-screen">
        <div class="bg-white p-9 max-w-xl w-full rounded-lg h-full flex flex-col justify-center">
            <div class="flex items-center justify-center">
                <img src="images/logo_itk.png" alt="Sim Layanan Kemahasiswaan" class="mr-5 w-28 h-28">
                <p class="text-4xl font-semibold text-customBlack">Sim Layanan Kemahasiswaan</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4 flex items-center">
                    <i class="fas fa-envelope mr-2 text-customBlack"></i>
                    <label for="email" class="block text-sm font-medium text-customBlack">Email</label>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" required class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="flex items-center">
                    <i class="fas fa-lock mr-2 text-gray-600"></i>
                    <label for="password" class="block text-sm font-medium text-customBlack">Password</label>
                </div>
                <div class="relative mb-4">
                    <input type="password" name="password" id="password" required class="mt-1 p-2 w-full border rounded-md pr-10">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility()">
                            <i id="password-toggle" class="fas fa-eye-slash text-gray-400"></i>
                        </span>
                </div>

                <script>
                    function togglePasswordVisibility() {
                        var passwordInput = document.getElementById('password');
                        var passwordToggle = document.getElementById('password-toggle');

                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            passwordToggle.classList.remove('fa-eye-slash');
                            passwordToggle.classList.add('fa-eye');
                        } else {
                            passwordInput.type = 'password';
                            passwordToggle.classList.remove('fa-eye');
                            passwordToggle.classList.add('fa-eye-slash');
                        }
                    }
                </script>

                <div class="relative flex justify-between">
                    <div class="absolute right-0 mb-12">
                        <a href="#" class="text-sm text-customBlack" style="text-decoration: underline;">Lupa Password?</a>
                    </div>
                </div>
                <button type="submit" class="w-full bg-customBlue text-white px-4 py-2 rounded-md mb-4 mt-8">Masuk</button>
                <div class="flex items-center">
                    <hr class="border-t border-gray-300 flex-grow mr-3 ml-9">
                    <span class="text-gray-700">ATAU</span>
                    <hr class="border-t border-gray-300 flex-grow ml-3 mr-9">
                </div>
                <button class="w-full bg-customBlue text-white px-4 py-2 rounded-md mt-4">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>