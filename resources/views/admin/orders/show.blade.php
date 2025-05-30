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
    <!-- Navbar -->
    <nav class="text-white p-4 shadow-md" style="background: linear-gradient(135deg, #EB4E30 0%, #ff6b3d 100%);">
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
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mx-auto py-8 px-4">
        <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Order Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Order #{{ $transaction->id }}</h1>
                        <p class="text-gray-600">Placed on {{ $transaction->tanggal->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        @php
                            $statusClasses = [
                                'Selesai' => 'bg-green-100 text-green-800',
                                'Dibatalkan' => 'bg-red-100 text-red-800',
                                'Menunggu Pembayaran' => 'bg-yellow-100 text-yellow-800',
                                'Diproses' => 'bg-blue-100 text-blue-800',
                                'Belum Bayar' => 'bg-gray-100 text-gray-800'
                            ];
                        @endphp
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClasses[$transaction->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $transaction->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="text-gray-900">{{ $transaction->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-gray-900">{{ $transaction->user->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-gray-900">{{ $transaction->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Order Items</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $item->menu->gambar ? asset('storage/' . $item->menu->gambar) : asset('images/default-food.png') }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->menu->nm_menu }}</div>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($item->menu->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                <div class="flex justify-between border-t border-gray-200 pt-4">
                    <dt class="text-base font-medium text-gray-900">Total</dt>
                    <dd class="text-base font-medium text-gray-900">Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</dd>
                </div>

                <!-- Status Update Form -->
                @if(in_array($transaction->status, ['Menunggu Pembayaran', 'Diproses', 'Belum Bayar']))
                <div class="mt-6">
                    <form action="{{ route('admin.orders.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center space-x-4">
                            <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                @foreach(\App\Models\Transaksi::STATUSES as $status)
                                    <option value="{{ $status }}" {{ $transaction->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>
