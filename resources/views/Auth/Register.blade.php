<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
  <title>Register - MyCanteen</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Tambahkan Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .input-group {
      position: relative;
    }
    .input-icon {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #6b7280;
    }
    .input-field {
      padding-left: 40px;
    }
  </style>
</head>
<body class="bg-red-50 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-sm p-8 bg-white rounded-xl shadow-lg">
    <!-- Logo -->
    <div class="text-center mb-6">
      <img src="{{ asset('logo/My.png') }}" alt="Logo" class="w-40 h-40 mx-auto mb-2" />
    </div>

    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
      <ul class="list-disc list-inside space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="mb-4 input-group">
        <i class="fas fa-user input-icon"></i>
        <input type="text" name="name" placeholder="Nama Lengkap"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-red-300 input-field"
               value="{{ old('name') }}" required>
      </div>

      <!-- Email -->
      <div class="mb-4 input-group">
        <i class="fas fa-envelope input-icon"></i>
        <input type="email" name="email" placeholder="Alamat Email"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-red-300 input-field"
               value="{{ old('email') }}" required>
      </div>

      <!-- Password -->
      <div class="mb-4 input-group">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" name="password" placeholder="Password"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-red-300 input-field"
               id="passwordInput" required>
        <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-gray-600"
           id="togglePassword"></i>
      </div>

      <!-- Confirm Password -->
      <div class="mb-6 input-group">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" name="password_confirmation" placeholder="Ulangi Password"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-red-300 input-field"
               id="confirmPasswordInput" required>
        <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-gray-600"
           id="toggleConfirmPassword"></i>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors">
        Register
      </button>
    </form>

    <!-- Login link -->
    <p class="mt-4 text-center text-sm text-gray-700">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:text-red-700 transition-colors">Masuk disini</a>
    </p>
  </div>

  <script>
    // Toggle Password Visibility
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

    // Toggle Confirm Password Visibility
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
      const confirmPasswordInput = document.getElementById('confirmPasswordInput');
      const icon = this;

      if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        confirmPasswordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });
  </script>
</body>
</html>
