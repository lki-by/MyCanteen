<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('logo/logo-tab.png') }}">
    <title>Order Management - MyCanteen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .pagination li {
            margin: 0 0.25rem;
        }
        .pagination li a, .pagination li span {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            border: 1px solid #d1d5db;
        }
        .pagination li.active span {
            background: linear-gradient(135deg, #EB4E30 0%, #ff6b3d 100%);
            color: white;
            border-color: #EB4E30;
        }
        .pagination li a:hover {
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-gray-100">

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
        <div class="max-w-6xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Order Management</h1>
                    <p class="text-gray-600">All customer orders</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{route('admin.index')}}" class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back to Dashboard
                    </a>
                </div>
            </div>

            @if($transactions->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No orders found</h3>
                    <p class="mt-1 text-sm text-gray-500">There are no orders placed by customers yet.</p>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transactions as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $transaction->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <img class="h-8 w-8 rounded-full object-cover mr-2"
                                                 src="{{ $transaction->user->avatar ? asset('storage/' . $transaction->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($transaction->user->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                                 alt="{{ $transaction->user->name }}">
                                            {{ $transaction->user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaction->user->phone ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaction->tanggal->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'Selesai' => 'bg-green-100 text-green-800',
                                                'Dibatalkan' => 'bg-red-100 text-red-800',
                                                'Menunggu Pembayaran' => 'bg-yellow-100 text-yellow-800',
                                                'Diproses' => 'bg-blue-100 text-blue-800',
                                                'Belum Bayar' => 'bg-gray-100 text-gray-800'
                                            ];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$transaction->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $transaction->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaction->cart->sum('quantity') }} items
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                        <a href="{{ route('admin.orders.show', $transaction->id) }}" class="text-orange-600 hover:text-orange-900 flex items-center">
                                            View
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                        @if(in_array($transaction->status, ['Menunggu Pembayaran', 'Diproses']))
                                        <form action="{{ route('admin.orders.update', $transaction->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Selesai">
                                            <button type="submit" class="text-green-600 hover:text-green-900 flex items-center">
                                                Complete
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if ($transactions->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white opacity-50 cursor-not-allowed">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $transactions->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Previous
                                </a>
                            @endif

                            @if ($transactions->hasMorePages())
                                <a href="{{ $transactions->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Next
                                </a>
                            @else
                                <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white opacity-50 cursor-not-allowed">
                                    Next
                                </span>
                            @endif
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">{{ $transactions->firstItem() }}</span>
                                    to
                                    <span class="font-medium">{{ $transactions->lastItem() }}</span>
                                    of
                                    <span class="font-medium">{{ $transactions->total() }}</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    {{ $transactions->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>

        document.getElementById('user-menu').addEventListener('click', function() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        });


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
