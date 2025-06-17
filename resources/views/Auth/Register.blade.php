<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
  <title>Register - MyCanteen</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .auth-container {
      background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.95) 100%);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.2);
    }
    .input-field {
      transition: all 0.3s ease;
    }
    .input-field:focus {
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center min-h-screen p-4">
  <div class="auth-container w-full max-w-md p-8 rounded-xl shadow-xl">
    <div class="text-center mb-8">
      <img src="{{ asset('logo/My.png') }}" alt="MyCanteen Logo" class="w-32 h-32 mx-auto mb-4" />
      <h1 class="text-2xl font-bold text-gray-800">Create Account</h1>
      <p class="text-gray-600 mt-2">Join us today</p>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
      <div class="flex items-center mb-2">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <span class="font-medium">Registration Error</span>
      </div>
      <ul class="list-disc list-inside pl-5 text-sm">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="name">
          Full Name
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-user text-gray-400"></i>
          </div>
          <input id="name" name="name" type="text" placeholder="Alby Nizam" required
                 class="input-field w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500"
                 value="{{ old('name') }}">
        </div>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
          Email Address
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-envelope text-gray-400"></i>
          </div>
          <input id="email" name="email" type="email" placeholder="Nama@email.com" required
                 class="input-field w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500"
                 value="{{ old('email') }}">
        </div>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
          Password
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-lock text-gray-400"></i>
          </div>
          <input id="password" name="password" type="password" placeholder="••••••••" required
                 class="input-field w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500">
          <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="togglePassword"></i>
          </div>
        </div>
        <p class="mt-1 text-xs text-gray-500">Minimum 3 characters</p>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="password_confirmation">
          Confirm Password
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-lock text-gray-400"></i>
          </div>
          <input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required
                 class="input-field w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500">
          <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="toggleConfirmPassword"></i>
          </div>
        </div>
      </div>

      <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-300">
        Create Account
      </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
      Already have an account?
      <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-500">
        Sign in
      </a>
    </div>
  </div>

  <script>

    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = this;

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });


    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
      const confirmPasswordInput = document.getElementById('password_confirmation');
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
