<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
  <title>Login - MyCanteen</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Tambahkan Font Awesome untuk ikon yang lebih bagus -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-red-50 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-lg">
    <div class="flex flex-col items-center mb-6">
      <!-- LOGO -->
      <img src="{{ asset('logo/My.png') }}" alt="Logo Kantinku" class="w-40 h-40 mb-2" />
    </div>

    <form method="POST" action="/login">
        @csrf
      <!-- Email -->
      @if($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Login gagal!</strong>
                <span class="block sm:inline">
                    {{ $errors->first() }}
                </span>
            </div>
        </div>
      @endif

      <div class="mb-4">
        <label class="block text-gray-700">
          <div class="flex items-center border rounded px-3 py-2 focus-within:border-red-500 focus-within:ring-1 focus-within:ring-red-500 transition-colors">
            <!-- Ikon Email yang lebih bagus -->
            <i class="fas fa-envelope text-gray-500 mr-2"></i>
            <input type="email" name="email" placeholder="Email" required
                   class="w-full outline-none bg-transparent placeholder-gray-400" />
          </div>
        </label>
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label class="block text-gray-700">
          <div class="flex items-center border rounded px-3 py-2 focus-within:border-red-500 focus-within:ring-1 focus-within:ring-red-500 transition-colors">
            <!-- Ikon Password yang lebih bagus -->
            <i class="fas fa-lock text-gray-500 mr-2"></i>
            <input type="password" name="password" placeholder="Password" required
                   class="w-full outline-none bg-transparent placeholder-gray-400" id="passwordInput" />
            <!-- Toggle visibility icon -->
            <i class="fas fa-eye text-gray-500 ml-2 cursor-pointer" id="togglePassword"></i>
          </div>
        </label>
      </div>

      <!-- Login Button -->
      <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition-colors">
        Login
      </button>
    </form>

    <!-- Register Link -->
    <p class="mt-4 text-center text-sm text-gray-700">
      Belum punya akun? <a href="/register" class="text-red-600 font-semibold hover:text-red-700 transition-colors">Daftar</a>
    </p>
  </div>

  <script>
    // Fungsi untuk toggle show/hide password
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('passwordInput');
      const icon = this;

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });
  </script>
</body>
</html>
