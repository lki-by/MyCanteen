<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
    <title>Order Details - MyCanteen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="text-white p-4 shadow-md" style="background:  linear-gradient(135deg, #EB4E30 0%, #ff6b3d 100%);">
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
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Order Details #{{ $transaction->id }}</h1>
                    <p class="text-gray-600">Order placed on {{ $transaction->tanggal->format('d M Y H:i') }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('user.orders.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back to Orders
                    </a>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Order Status</p>
                            @php
                                $statusClasses = [
                                    'Selesai' => 'bg-green-100 text-green-800',
                                    'Dibatalkan' => 'bg-red-100 text-red-800',
                                    'Menunggu Pembayaran' => 'bg-yellow-100 text-yellow-800',
                                    'Diproses' => 'bg-blue-100 text-blue-800',
                                    'Belum Bayar' => 'bg-gray-100 text-gray-800'
                                ];
                            @endphp
                            <p class="mt-1 text-sm font-medium">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$transaction->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $transaction->status }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Amount</p>
                            <p class="mt-1 text-lg font-bold text-gray-900">Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($transaction->cart as $item)
                    <div class="px-6 py-4">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                @if($item->menu->gambar)
                                    <img src="{{ asset('storage/' . $item->menu->gambar) }}" alt="{{ $item->menu->nm_menu }}" class="h-20 w-20 rounded-md object-cover">
                                @else
                                    <div class="h-20 w-20 rounded-md bg-gray-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:justify-between">
                                    <div class="mb-2 md:mb-0">
                                        <h4 class="text-lg font-medium text-gray-900">{{ $item->menu->nm_menu }}</h4>
                                        <p class="text-sm text-gray-500">{{ $item->menu->deskripsi }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-900">Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-900">Total</span>
                        <span class="text-xl font-bold text-gray-900">Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle dropdown menu (consistent with index.blade.php)
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
    </script>
</body>
</html>
