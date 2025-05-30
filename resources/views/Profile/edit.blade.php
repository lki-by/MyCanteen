<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
    <title>Edit Profil - MyCanteen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar (Updated) --><nav class="text-white p-4 shadow-md" style="background: linear-gradient(135deg, #EB4E30 0%, #ff6b3d 100%); ">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-xl font-bold flex items-center">
            <img src="{{ asset('logo/Logo.png') }}" alt="MyCanteen" class="h-8 mr-2">
            MyCanteen
        </a>
        <div class="flex items-center">
            <div class="relative">
                <div class="flex items-center cursor-pointer" id="user-menu">
                    <img id="current-avatar"
                         class="h-8 w-8 rounded-full object-cover border-2 border-white"
                         src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                         alt="Profile Picture">
                    <span class="ml-2">{{ Auth::user()->name }}</span>
                </div>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden" id="dropdown-menu">
                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                    <a href="{{ route('user.orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Order</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>


        <!-- Main Content -->
        <div class="container mx-auto py-8 px-4">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">My Profil</h1>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Photo -->
                        <div class="mb-8">
                            <div class="flex items-center space-x-6">
                                <div class="shrink-0">
                                    <img id="preview-avatar" class="h-24 w-24 object-cover rounded-full border-2 border-orange-500"
                                        src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                        alt="Current profile photo">
                                </div>
                                <div class="block">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Foto Profil
                                    </label>
                                    <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*">
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="document.getElementById('avatar').click()"
                                            class="px-4 py-2 bg-orange-500 text-white text-sm font-medium rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                            Pilih Foto
                                        </button>
                                        @if(Auth::user()->avatar)
                                        <button type="button" onclick="confirmDeleteAvatar()"
                                            class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Hapus Foto
                                        </button>
                                        @endif
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">
                                        PNG, JPG, JPEG (Maks. 5MB)
                                    </p>
                                    @error('avatar')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm p-2 border" required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm p-2 border bg-gray-100" readonly>
                            <p class="mt-1 text-xs text-gray-500">Email tidak dapat diubah</p>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm p-2 border"
                                placeholder="Contoh: 081234567890">
                            @error('phone')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8">
                            <a href="/mycanteen" class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-3">
                                Back
                            </a>

                            <button type="submit" class="px-4 py-2 bg-orange-500 text-white text-sm font-medium rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                Save Change
                            </button>

                        </div>
                    </form>

                    <!-- Delete Avatar Form (hidden) -->
                    @if(Auth::user()->avatar)
                    <form id="delete-avatar-form" method="POST" action="{{ route('profile.avatar.destroy') }}" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview avatar when selected and update navbar profile picture
        document.getElementById('avatar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update preview in form
                    document.getElementById('preview-avatar').src = e.target.result;
                    // Update avatar in navbar
                    document.getElementById('current-avatar').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Toggle dropdown menu
        document.getElementById('user-menu').addEventListener('click', function() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdown-menu');
            const userMenu = document.getElementById('user-menu');
            if (!userMenu.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Confirm delete avatar
        function confirmDeleteAvatar() {
            if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                document.getElementById('delete-avatar-form').submit();
            }
        }
    </script>
</body>
</html>
