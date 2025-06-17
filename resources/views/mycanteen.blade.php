<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyCanteen</title>
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('logo/logo-tab.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .cart-overlay {
      transition: right 0.3s ease;
    }
    .popup-overlay {
      transition: all 0.3s ease;
    }
    .popup-container {
      transition: transform 0.3s ease;
    }
    .profile-dropdown {
      display: none;
    }
    .profile-dropdown.active {
      display: block;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans text-gray-800">

  <nav class="sticky top-0 z-50 flex flex-col sm:flex-row items-center justify-between p-4 bg-gradient-to-r from-red-500 to-orange-500 text-white shadow-lg">
    <div class="flex items-center space-x-2 w-full sm:w-auto justify-between sm:justify-start mb-3 sm:mb-0">
      <div class="flex items-center space-x-2">
        <img src="{{ asset('logo/Logo.png') }}" alt="MyCanteen" class="w-10 h-10 sm:w-12 sm:h-12">
        <h1 class="text-lg sm:text-xl font-bold">MyCanteen</h1>
      </div>
    </div>

    <div class="hidden sm:block sm:flex-1 sm:max-w-xl mx-4 relative">
      <input type="text" id="search-input" class="w-full py-2 px-4 rounded-full bg-white bg-opacity-90 focus:bg-white focus:ring-2 focus:ring-white focus:ring-opacity-30 text-black" placeholder="Cari menu makanan...">
      <button class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-red-500 rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600">
        <i class="fas fa-search text-white text-sm"></i>
      </button>
    </div>

    <div class="flex items-center space-x-4 sm:space-x-6">

      <div class="relative">
        <button onclick="toggleProfileDropdown()" class="flex items-center space-x-2 hover:translate-y-[-2px] transition-transform focus:outline-none">
          <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white border-2 border-white shadow-md overflow-hidden">
            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                 alt="Avatar" class="w-full h-full object-cover">
          </div>
          <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
          <i class="fas fa-chevron-down text-xs hidden sm:inline"></i>
        </button>

        <div id="profileDropdown" class="profile-dropdown absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 py-1">
          <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            <i class="fas fa-user mr-2"></i> My Profile
          </a>
          <a href="{{ route('user.orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            <i class="fas fa-clipboard-list mr-2"></i> Orders
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
          </form>
        </div>
      </div>

      <button onclick="openCart()" class="relative hover:translate-y-[-2px] transition-transform">
        <i class="fas fa-shopping-cart text-lg sm:text-xl"></i>
        <span id="cartCount" class="absolute -top-2 -right-2 bg-yellow-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">0</span>
      </button>
    </div>
  </nav>

  <!-- Category Filter - Perbaikan untuk mobile -->
  <div class="flex flex-wrap gap-2 sm:gap-4 my-3 sm:my-5 px-2 sm:px-4 justify-center" id="categoryFilter">
    <button data-category="all" class="category-btn px-3 py-1 sm:px-4 sm:py-2 rounded-full border-2 border-red-500 font-bold text-red-500 hover:bg-red-500 hover:text-white transition-colors active">Semua</button>
    <button data-category="Makanan" class="category-btn px-3 py-1 sm:px-4 sm:py-2 rounded-full border-2 border-red-500 font-bold text-red-500 hover:bg-red-500 hover:text-white transition-colors">Makanan</button>
    <button data-category="Minuman" class="category-btn px-3 py-1 sm:px-4 sm:py-2 rounded-full border-2 border-red-500 font-bold text-red-500 hover:bg-red-500 hover:text-white transition-colors">Minuman</button>
    <button data-category="Snack" class="category-btn px-3 py-1 sm:px-4 sm:py-2 rounded-full border-2 border-red-500 font-bold text-red-500 hover:bg-red-500 hover:text-white transition-colors">Snack</button>
  </div>

  <!-- Product Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 px-2 sm:px-4 pb-6 sm:pb-8">
    @foreach ($menus as $menu)
    @if($menu->kategori)
    <div class="product-item bg-white rounded-lg sm:rounded-xl shadow-sm sm:shadow-md overflow-hidden hover:shadow-md sm:hover:shadow-lg transition-shadow cursor-pointer flex flex-col h-full"
         onclick="showProductPopup({{ $menu->id }}, '{{ $menu->nm_menu }}', {{ $menu->harga }}, '{{ $menu->kategori->nm_kategori }}', 4.4, '{{ $menu->deskripsi ?? 'Tidak ada deskripsi' }}', '{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://via.placeholder.com/150' }}')"
         data-category="{{ $menu->kategori->nm_kategori }}"
         data-name="{{ strtolower($menu->nm_menu) }}">
      <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded flex items-center">
        <span>{{ $menu->Rating }}</span>
      </div>
      <img src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://via.placeholder.com/150' }}"
           alt="{{ $menu->nm_menu }}"
           class="w-full h-32 sm:h-40 object-cover"
           onerror="this.src='https://via.placeholder.com/150'">
      <div class="p-2 sm:p-4 flex flex-col flex-grow">
        <h3 class="font-semibold text-gray-800 text-sm sm:text-base mb-1 sm:mb-2 line-clamp-2">{{ $menu->nm_menu }}</h3>
        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded self-start mb-2 sm:mb-3">{{ $menu->kategori->nm_kategori }}</span>
        <p class="text-red-500 font-bold text-base sm:text-lg mb-3 sm:mb-4">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
        <button class="mt-auto bg-red-500 hover:bg-red-600 text-white text-sm sm:text-base py-1 sm:py-2 px-3 sm:px-4 rounded-full transition-colors"
                onclick="event.stopPropagation();addToCart({{ $menu->id }}, {{ $menu->harga }}, '{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://via.placeholder.com/150' }}', '{{ $menu->nm_menu }}')">
          Add To Cart
        </button>
      </div>
    </div>
    @endif
    @endforeach
  </div>

  <div id="productPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 invisible transition-opacity z-50">
    <div class="bg-white rounded-xl w-full max-w-xs sm:max-w-md max-h-[90vh] overflow-y-auto transform translate-y-5 mx-2 sm:mx-0">
      <div class="p-4 sm:p-6 relative">
        <button onclick="closePopup()" class="absolute top-2 sm:top-4 right-2 sm:right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <img id="popupImg" src="" alt="" class="w-full h-40 sm:h-48 object-cover rounded-lg mb-3 sm:mb-4">
        <h2 id="popupTitle" class="text-xl sm:text-2xl font-bold text-gray-800 mb-1 sm:mb-2"></h2>
        <div id="popupRating" class="flex items-center text-yellow-500 mb-1 sm:mb-2"></div>
        <span id="popupCategory" class="inline-block bg-gray-100 text-gray-600 text-xs sm:text-sm px-2 sm:px-3 py-1 rounded-full mb-2 sm:mb-3"></span>
        <p id="popupPrice" class="text-red-500 font-bold text-xl sm:text-2xl my-2 sm:my-3"></p>
        <p id="popupDescription" class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6"></p>
        <button onclick="addToCartFromPopup()" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 sm:py-3 px-3 sm:px-4 rounded-lg font-bold transition-colors text-sm sm:text-base">
          Add to Cart
        </button>
      </div>
    </div>
  </div>

  <div id="cartSidebar" class="fixed top-0 right-[-100%] w-full max-w-xs sm:max-w-md h-full bg-white shadow-lg z-50 overflow-y-auto">
    <div class="p-3 sm:p-4 border-b flex justify-between items-center">
      <h3 class="text-lg sm:text-xl font-bold">Keranjang Belanja</h3>
      <button onclick="closeCart()" class="text-gray-500 hover:text-gray-700 text-xl sm:text-2xl">&times;</button>
    </div>

    <div id="cartItems" class="p-3 sm:p-4">
      <div class="text-center py-8 sm:py-10 text-gray-500">Keranjang belanja kosong</div>
    </div>

    <div id="cartFooter" class="p-3 sm:p-4 border-t hidden">
      <div class="flex justify-between items-center mb-3 sm:mb-4">
        <span class="font-bold text-base sm:text-lg">Total:</span>
        <span id="cartTotal" class="font-bold text-base sm:text-lg">Rp 0</span>
      </div>
      <button onclick="checkout()" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 sm:py-3 px-3 sm:px-4 rounded-lg font-bold transition-colors text-sm sm:text-base">
        Checkout
      </button>
    </div>
  </div>

  <script>
    // Profile dropdown function
    function toggleProfileDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('active');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('profileDropdown');
      const profileBtn = document.querySelector('[onclick="toggleProfileDropdown()"]');

      if (!profileBtn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('active');
      }
    });

    function showProductPopup(menu_id, name, price, category, rating, description, image) {
      document.getElementById('popupTitle').textContent = name;
      document.getElementById('popupPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
      document.getElementById('popupCategory').textContent = category;
      document.getElementById('popupRating').innerHTML = `<span>${rating}</span>`;
      document.getElementById('popupDescription').textContent = description;
      document.getElementById('popupImg').src = image;

      document.getElementById('productPopup').currentProduct = {
        menu_id,
        name,
        price,
        image
      };

      document.getElementById('productPopup').classList.remove('invisible', 'opacity-0');
      document.getElementById('productPopup').classList.add('visible', 'opacity-100');
      document.body.style.overflow = 'hidden';
    }

    function closePopup() {
      document.getElementById('productPopup').classList.remove('visible', 'opacity-100');
      document.getElementById('productPopup').classList.add('invisible', 'opacity-0');
      document.body.style.overflow = 'auto';
    }

    function addToCartFromPopup() {
      const product = document.getElementById('productPopup').currentProduct;
      addToCart(product.menu_id, product.price, product.image, product.name);
      closePopup();
    }

    // Cart Functions (remain the same as before)
    async function addToCart(menu_id, price, image, name) {
      try {
        const _token = "{{ csrf_token() }}";
        const response = await fetch("{{ route('cart.add') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            menu_id: menu_id,
            price: price,
            quantity: 1
          })
        });

        const data = await response.json();

        if (response.ok) {
          updateCartCount();
          updateCartDisplay();
          alert(`${name} telah ditambahkan ke keranjang`);
        } else {
          throw new Error(data.message || 'Failed to add to cart');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Gagal menambahkan ke keranjang: ' + error.message);
      }
    }

    async function updateCartCount() {
      try {
        const response = await fetch("{{ route('cart.count') }}");
        const data = await response.json();
        document.getElementById('cartCount').textContent = data.count;
      } catch (error) {
        console.error('Error fetching cart count:', error);
      }
    }

    async function updateCartDisplay() {
      try {
        const response = await fetch("{{ route('cart.items') }}");
        const cartItems = await response.json();

        const cartItemsElement = document.getElementById('cartItems');
        const cartFooterElement = document.getElementById('cartFooter');

        if (cartItems.length === 0) {
          cartItemsElement.innerHTML = '<div class="text-center py-8 sm:py-10 text-gray-500">Keranjang belanja kosong</div>';
          cartFooterElement.classList.add('hidden');
          return;
        }

        cartFooterElement.classList.remove('hidden');

        let itemsHTML = '';
        let total = 0;

        cartItems.forEach((item) => {
          total += item.total;

          itemsHTML += `
            <div class="flex gap-3 sm:gap-4 pb-3 sm:pb-4 mb-3 sm:mb-4 border-b">
              <img src="${item.menu.gambar ? '{{ asset('storage') }}/' + item.menu.gambar : 'https://via.placeholder.com/150'}"
                   alt="${item.menu.nm_menu}"
                   class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg">
              <div class="flex-1">
                <h4 class="font-medium text-sm sm:text-base">${item.menu.nm_menu}</h4>
                <p class="text-red-500 font-bold text-sm sm:text-base">Rp ${item.menu.harga.toLocaleString('id-ID')}</p>
                <div class="flex items-center gap-2 sm:gap-3 mt-1 sm:mt-2">
                  <div class="flex items-center gap-1 sm:gap-2">
                    <button onclick="updateQuantity(${item.id}, -1)" class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300 text-xs sm:text-sm">-</button>
                    <span class="w-4 sm:w-5 text-center text-sm sm:text-base">${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, 1)" class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300 text-xs sm:text-sm">+</button>
                  </div>
                  <button onclick="removeItem(${item.id})" class="ml-auto text-red-500 hover:text-red-700 text-xs sm:text-sm">Hapus</button>
                </div>
              </div>
            </div>
          `;
        });

        cartItemsElement.innerHTML = itemsHTML;
        document.getElementById('cartTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
      } catch (error) {
        console.error('Error fetching cart items:', error);
      }
    }

    async function updateQuantity(cartItemId, change) {
      try {
        const _token = "{{ csrf_token() }}";
        const response = await fetch("{{ route('cart.update') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            cart_item_id: cartItemId,
            change: change
          })
        });

        if (response.ok) {
          updateCartCount();
          updateCartDisplay();
        } else {
          const data = await response.json();
          throw new Error(data.message || 'Failed to update quantity');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Gagal mengupdate jumlah: ' + error.message);
      }
    }

    async function removeItem(cartItemId) {
      try {
        const _token = "{{ csrf_token() }}";
        const response = await fetch("{{ route('cart.remove') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            cart_item_id: cartItemId
          })
        });

        if (response.ok) {
          updateCartCount();
          updateCartDisplay();
        } else {
          const data = await response.json();
          throw new Error(data.message || 'Failed to remove item');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Gagal menghapus item: ' + error.message);
      }
    }

    async function checkout() {
      if (document.getElementById('cartItems').querySelector('.empty-cart')) {
        alert('Keranjang belanja kosong');
        return;
      }

      if (confirm('Apakah Anda yakin ingin checkout?')) {
        try {
          const _token = "{{ csrf_token() }}";
          const response = await fetch("{{ route('checkout.process') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': _token,
              'Accept': 'application/json'
            }
          });

          const data = await response.json();

          if (response.ok) {
            alert('Checkout berhasil!');
            updateCartCount();
            updateCartDisplay();
            closeCart();
          } else {
            throw new Error(data.message || 'Checkout failed');
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Gagal checkout: ' + error.message);
        }
      }
    }

    // UI Functions
    function openCart() {
      document.getElementById('cartSidebar').classList.remove('right-[-100%]');
      document.getElementById('cartSidebar').classList.add('right-0');
      document.body.style.overflow = 'hidden';
      updateCartDisplay();
    }

    function closeCart() {
      document.getElementById('cartSidebar').classList.remove('right-0');
      document.getElementById('cartSidebar').classList.add('right-[-100%]');
      document.body.style.overflow = 'auto';
    }

    // Perbaikan untuk filter kategori di mobile
    document.addEventListener('DOMContentLoaded', function() {
      updateCartCount();
      updateCartDisplay();

      // Event delegation untuk filter kategori (bekerja di mobile dan desktop)
      document.getElementById('categoryFilter').addEventListener('click', function(e) {
        if (e.target.classList.contains('category-btn')) {
          document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
          e.target.classList.add('active');

          const category = e.target.dataset.category.toLowerCase();
          filterProducts(category);
        }
      });

      // Add data-name attribute to all product items for search
      document.querySelectorAll('.product-item').forEach(item => {
        const name = item.querySelector('h3').textContent.toLowerCase();
        item.setAttribute('data-name', name);
      });
    });

    // Fungsi filterProducts dan lainnya tetap sama
    function filterProducts(category = null, searchKeyword = null) {
      const products = document.querySelectorAll('.product-item');
      const activeCategory = category || document.querySelector('.category-btn.active')?.dataset.category.toLowerCase() || 'all';
      const keyword = searchKeyword || document.getElementById('search-input')?.value.toLowerCase() || '';

      products.forEach(product => {
        const productCategory = product.dataset.category.toLowerCase();
        const productName = product.dataset.name;

        const categoryMatch = activeCategory === 'all' || productCategory === activeCategory;
        const searchMatch = keyword === '' || productName.includes(keyword);

        if (categoryMatch && searchMatch) {
          product.style.display = 'flex';
        } else {
          product.style.display = 'none';
        }
      });
    }

    document.getElementById("search-input").addEventListener("input", function() {
      const keyword = this.value.toLowerCase();
      filterProducts(null, keyword);
    });

    document.addEventListener('DOMContentLoaded', function() {
      updateCartCount();
      updateCartDisplay();

      document.querySelectorAll('.product-item').forEach(item => {
        const name = item.querySelector('h3').textContent.toLowerCase();
        item.setAttribute('data-name', name);
      });
    });
  </script>
</body>
</html>
