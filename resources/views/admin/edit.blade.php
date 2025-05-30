<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Menu - MyCanteen</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

   
    <nav class="text-white p-4 shadow-md" style="background: linear-gradient(135deg, #EB4E30 0%, #ff6b3d 100%);">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold flex items-center">
                <img src="{{ asset('logo/Logo.png') }}" alt="MyCanteen" class="h-8 mr-2">
                MyCanteen
            </a>
        </div>
    </nav>


    <div class="container mx-auto mt-10 max-w-2xl">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-red-500">Edit Menu</h2>
            <form action="{{ route('admin.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Nama Menu:</label>
                    <input type="text" name="nm_menu" value="{{ $menu->nm_menu }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Harga:</label>
                    <input type="number" name="harga" value="{{ $menu->harga }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Deskripsi:</label>
                    <textarea name="deskripsi"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-pink-300">{{ $menu->deskripsi }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Gambar (opsional):</label>
                    <input type="file" name="gambar"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1">
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Simpan</button>
                    <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
