<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    MyCanteen
    </title>
<link rel="icon" type="image/png"  sizes="512x512"  href="{{ asset('logo/logo-tab.png') }}"  >

  <style>
:root {
      --primary: #EB4E30;
      --secondary: #ff9f1c;
      --dark: #2b2d42;
      --light: #f8f9fa;
      --success: #2ecc71;
    }

    body {
      margin: 0;
      font-family: 'Poppins', Arial, sans-serif;
      background: #f5f5f5;
      color: #333;
    }

    /* Navbar */
    .navbar {
      background: linear-gradient(135deg, #EB4E30 0%, #ff6b3d 100%);
      color: white;
      padding: 16px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 4px 12px rgba(238, 77, 45, 0.2);
    }

    .navbar h1 {
      margin: 0;
      font-size: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .navbar img {
      height: 40px;
      filter: drop-shadow(0 1px 1px rgba(0,0,0,0.1));
    }

    .user-cart {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-left: auto;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .user-info:hover {
      transform: translateY(-2px);
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: white;
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      border: 2px solid white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .cart-icon {
      position: relative;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .cart-icon:hover {
      transform: translateY(-2px);
    }

    .cart-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background: var(--secondary);
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: bold;
      box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    /* Rest of your existing CSS remains the same */
    /* ... */

    /* Updated Avatar Image Style */
    .user-avatar-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    /* Add smooth transition to navbar */
    .navbar {
      transition: all 0.3s ease;
    }

    /* Add slight scale effect on avatar hover */
    .user-avatar:hover {
      transform: scale(1.05);
    }


    /* Kategori */
    .kategori {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin: 20px 0;
      padding: 0 20px;
      flex-wrap: wrap;
    }

    .kategori button {
      padding: 10px 20px;
      border: none;
      background-color: #fff;
      color: var(--primary);
      border: 2px solid var(--primary);
      border-radius: 20px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .kategori button.active,
    .kategori button:hover {
      background-color: var(--primary);
      color: #fff;
    }

    /* Produk Container */
    .produk-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 20px;
      padding: 0 20px 40px;
    }

    .produk {
      background: white;
      border-radius: 12px;
      padding: 16px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .produk:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .produk-rating {
      position: absolute;
      top: 10px;
      right: 10px;
      background: var(--success);
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 2px;
    }

    .produk img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 12px;
    }

    .produk h3 {
      font-size: 16px;
      margin: 0 0 8px;
      color: var(--dark);
    }

    .produk-price {
      color: var(--primary);
      font-weight: bold;
      font-size: 18px;
      margin: 8px 0;
    }

    .produk-category {
      display: inline-block;
      background: #f0f0f0;
      color: #666;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      margin-bottom: 12px;
    }

    .add-to-cart {
      background: var(--primary);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: bold;
      width: 100%;
      transition: background 0.3s ease;
    }
    .produk {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.produk img {
  width: 100%;
  height: 160px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 12px;
  background: #f5f5f5;
}

.produk-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  padding: 0 8px;
}

.produk h3 {
  font-size: 16px;
  margin: 0 0 8px;
  color: var(--dark);
  line-height: 1.3;
  min-height: 40px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.produk-category {
  display: inline-block;
  background: #f0f0f0;
  color: #666;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  margin-bottom: 12px;
  align-self: flex-start;
}

.produk-price {
  color: var(--primary);
  font-weight: bold;
  font-size: 18px;
  margin: 8px 0 16px;
}

.add-to-cart {
  margin-top: auto;
}

    .add-to-cart:hover {
      background: #d14326;
    }

    /* Popup Detail Produk */
    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .popup-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .popup-container {
      background: white;
      border-radius: 12px;
      width: 90%;
      max-width: 500px;
      max-height: 90vh;
      overflow-y: auto;
      padding: 24px;
      position: relative;
      transform: translateY(20px);
      transition: transform 0.3s ease;
    }

    .popup-overlay.active .popup-container {
      transform: translateY(0);
    }

    .popup-close {
      position: absolute;
      top: 16px;
      right: 16px;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #666;
    }

    .popup-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 16px;
    }

    .popup-title {
      font-size: 24px;
      margin: 0 0 8px;
      color: var(--dark);
    }

    .popup-rating {
      display: flex;
      align-items: center;
      gap: 4px;
      color: #ffc107;
      margin-bottom: 8px;
    }

    .popup-price {
      font-size: 24px;
      color: var(--primary);
      font-weight: bold;
      margin: 12px 0;
    }

    .popup-category {
      display: inline-block;
      background: #f0f0f0;
      color: #666;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 14px;
      margin-bottom: 16px;
    }

    .popup-description {
      margin-bottom: 24px;
      line-height: 1.6;
    }

    .popup-actions {
      display: flex;
      gap: 12px;
    }

    .popup-btn {
      flex: 1;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .popup-btn-primary {
      background: var(--primary);
      color: white;
      border: none;
    }

    .popup-btn-primary:hover {
      background: #d14326;
    }

    .popup-btn-secondary {
      background: white;
      color: var(--primary);
      border: 2px solid var(--primary);
    }

    .popup-btn-secondary:hover {
      background: #ffeeea;
    }

    /* Cart Sidebar */
    .cart-overlay {
      position: fixed;
      top: 0;
      right: -100%;
      width: 100%;
      max-width: 400px;
      height: 100vh;
      background: white;
      box-shadow: -5px 0 15px rgba(0,0,0,0.1);
      z-index: 1000;
      transition: right 0.3s ease;
      overflow-y: auto;
    }

    .cart-overlay.active {
      right: 0;
    }

    .cart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid #eee;
    }

    .cart-title {
      margin: 0;
      font-size: 20px;
    }

    .cart-close {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
    }

    .cart-items {
      padding: 20px;
    }

    .cart-item {
      display: flex;
      gap: 16px;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }

    .cart-item-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }

    .cart-item-details {
      flex: 1;
    }

    .cart-item-name {
      margin: 0 0 8px;
      font-size: 16px;
    }

    .cart-item-price {
      color: var(--primary);
      font-weight: bold;
      margin-bottom: 8px;
    }

    .cart-item-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .cart-item-qty {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .qty-btn {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #f0f0f0;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .qty-value {
      min-width: 20px;
      text-align: center;
    }

    .remove-item {
      background: none;
      border: none;
      color: #ff6b6b;
      cursor: pointer;
      margin-left: auto;
    }

    .cart-footer {
      padding: 20px;
      border-top: 1px solid #eee;
    }

    .cart-total {
      display: flex;
      justify-content: space-between;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .checkout-btn {
      width: 100%;
      padding: 14px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .checkout-btn:hover {
      background: #d14326;
    }

    .empty-cart {
      text-align: center;
      padding: 40px 20px;
      color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .produk-container {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
      }

      .popup-container {
        width: 95%;
        padding: 16px;
      }

      .popup-actions {
        flex-direction: column;
      }

      .cart-overlay {
        max-width: 100%;
      }
    }
    /* Navbar Search */
.navbar-search-container {
  flex: 1;
  max-width: 500px;
  margin: 0 20px;
  position: relative;
  margin-left:225px;
}

.navbar-search-input {
  width: 100%;
  padding: 10px 10px;
  padding-right: 1px;
  font-size: 14px;
  border: none;
  border-radius: 30px;
  outline: none;
  background: rgba(255,255,255,0.9);
  transition: all 0.3s ease;
  color: var(--dark);
}

.navbar-search-input:focus {
  background: white;
  box-shadow: 0 0 0 2px rgba(255,255,255,0.3);
}

.navbar-search-button {
  position: absolute;
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
  background: var(--primary);
  border: none;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.3s ease;
}

.navbar-search-button:hover {
  background: #d14326;
}

.search-icon {
  color: white;
  width: 16px;
  height: 16px;
}

@media (max-width: 1024px) {
  .navbar-search-container {
    max-width: 400px;
    margin: 0 15px;
  }
}

@media (max-width: 768px) {
  .navbar-search-container {
    order: 3;
    width: 100%;
    max-width: 100%;
    margin: 10px 0 0 0;
    display: none; /* Hidden by default on mobile */
  }

  .navbar-search-input {
    padding: 8px 15px;
    padding-right: 40px;
  }

  .navbar-search-button {
    width: 30px;
    height: 30px;
  }

  /* Optional: Add a search icon to toggle search on mobile */
  .mobile-search-toggle {
    display: none;
  }

  @media (max-width: 768px) {
    .mobile-search-toggle {
      display: flex;
      margin-right: 15px;
    }

    .navbar-search-container.active {
      display: block;
    }
  }
}

.produk[style*="display: none"] {
  display: none !important;
}
 .text-3d {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3), -2px -2px 4px rgba(255,255,255,0.8);
  }

  </style>
</head>


<body>
  <div class="navbar">
    <h1>
      <img src="{{ asset('logo/Logo.png') }}" alt="MyCanteen" class="w-48 h-auto mb-2" >
       MyCanteen
    </h1>
    <div class="navbar-search-container">
      <input type="text" id="search-input" class="navbar-search-input" placeholder="Cari menu makanan...">
      <button class="navbar-search-button">
        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </div>

    <div class="user-cart">
        @if (!Auth::user()->hasVerifiedEmail())
            <a href="{{ route('verification.send') }}">Send email</a>
        @endif
      <a href="{{ route('profile.edit') }}" class="user-info" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
        <div class="user-avatar">
          <img
            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
            alt="Avatar"
            class="user-avatar-img"
          />
        </div>
        <span>{{ Auth::user()->name }}</span>
      </a>

      <div class="cart-icon" onclick="openCart()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="9" cy="21" r="1"></circle>
          <circle cx="20" cy="21" r="1"></circle>
          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <div class="cart-count" id="cartCount">0</div>
      </div>
    </div>
  </div>

  <div class="kategori">
    <button class="active" data-category="all">Semua</button>
    <button data-category="Makanan">Makanan</button>
    <button data-category="Minuman">Minuman</button>
    <button data-category="Snack">Snack</button>
</div>

  <div class="produk-container" id="produkContainer">
    @foreach ($menus as $menu)
    @if($menu->kategori)
    <div class="produk"
         onclick="showProductPopup({{ $menu->id }}, '{{ $menu->nm_menu }}', {{ $menu->harga }}, '{{ $menu->kategori->nm_kategori }}', 4.4, '{{ $menu->deskripsi ?? 'Tidak ada deskripsi' }}', '{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://via.placeholder.com/150' }}')"
         data-category="{{ $menu->kategori->nm_kategori }}">
      <div class="produk-rating">
        <span>{{ $menu->Rating}}</span>
      </div>
      <img src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://via.placeholder.com/150' }}"
           alt="{{ $menu->nm_menu }}"
           onerror="this.src='https://via.placeholder.com/150'">
      <div class="produk-content">
        <h3>{{ $menu->nm_menu }}</h3>
        <span class="produk-category">{{ $menu->kategori->nm_kategori }}</span>
        <p class="produk-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
      </div>
      <button class="add-to-cart"
              onclick="event.stopPropagation();addToCart({{ $menu->id }}, {{ $menu->harga }}, '{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://via.placeholder.com/150' }}', '{{ $menu->nm_menu }}')">
        Add To Cart
      </button>
    </div>
    @endif
    @endforeach
</div>

<div class="popup-overlay" id="productPopup">
  <div class="popup-container">
    <button class="popup-close" onclick="closePopup()">&times;</button>
    <img src="" alt="" class="popup-img" id="popupImg">
    <h2 class="popup-title" id="popupTitle"></h2>
    <div class="popup-rating" id="popupRating"></div>
    <div class="popup-category" id="popupCategory"></div>
    <p class="popup-price" id="popupPrice"></p>
    <p class="popup-description" id="popupDescription"></p>
    <div class="popup-actions">
      <button class="popup-btn popup-btn-primary" onclick="addToCartFromPopup()">Add to Cart</button>
    </div>
  </div>
</div>



  <div class="cart-overlay" id="cartSidebar">
    <div class="cart-header">
      <h3 class="cart-title">Keranjang Belanja</h3>
      <button class="cart-close" onclick="closeCart()">&times;</button>
    </div>
    <div class="cart-items" id="cartItems">
      <div class="empty-cart">Keranjang belanja kosong</div>
    </div>
    <div class="cart-footer" id="cartFooter" style="display: none;">
      <div class="cart-total">
        <span>Total:</span>
        <span id="cartTotal">Rp 0</span>
      </div>
      <button class="checkout-btn" onclick="checkout()">Checkout</button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      updateCartCount();
      updateCartDisplay();
    });

    // Product Popup Functions
    function showProductPopup(menu_id, name, price, category, rating, description, image) {
      document.getElementById('popupTitle').textContent = name;
      document.getElementById('popupPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
      document.getElementById('popupCategory').textContent = category;
      document.getElementById('popupRating').innerHTML = `<span>{{{ $menu->Rating}}}</span>`;
      document.getElementById('popupDescription').textContent = description;
      document.getElementById('popupImg').src = image;

      document.getElementById('productPopup').currentProduct = {
        menu_id,
        name,
        price,
        image
      };

      document.getElementById('productPopup').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closePopup() {
      document.getElementById('productPopup').classList.remove('active');
      document.body.style.overflow = 'auto';
    }

    function addToCartFromPopup() {
      const product = document.getElementById('productPopup').currentProduct;
      addToCart(product.menu_id, product.price, product.image, product.name);
      closePopup();
    }

    // Cart Functions
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
          cartItemsElement.innerHTML = '<div class="empty-cart">Keranjang belanja kosong</div>';
          cartFooterElement.style.display = 'none';
          return;
        }

        cartFooterElement.style.display = 'block';

        let itemsHTML = '';
        let total = 0;

        cartItems.forEach((item) => {
          total += item.total;

          itemsHTML += `
            <div class="cart-item">
              <img src="${item.menu.gambar ? '{{ asset('storage') }}/' + item.menu.gambar : 'https://via.placeholder.com/150'}"
                   alt="${item.menu.nm_menu}"
                   class="cart-item-img">
              <div class="cart-item-details">
                <h4 class="cart-item-name">${item.menu.nm_menu}</h4>
                <p class="cart-item-price">Rp ${item.menu.harga.toLocaleString('id-ID')}</p>
                <div class="cart-item-actions">
                  <div class="cart-item-qty">
                    <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                    <span class="qty-value">${item.quantity}</span>
                    <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                  </div>
                  <button class="remove-item" onclick="removeItem(${item.id})">Hapus</button>
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
      document.getElementById('cartSidebar').classList.add('active');
      document.body.style.overflow = 'hidden';
      updateCartDisplay();
    }

    function closeCart() {
      document.getElementById('cartSidebar').classList.remove('active');
      document.body.style.overflow = 'auto';
    }

    document.querySelectorAll('.kategori button').forEach(button => {
  button.addEventListener('click', function() {

    document.querySelectorAll('.kategori button').forEach(btn => btn.classList.remove('active'));


    this.classList.add('active');


    const category = this.dataset.category;


    filterProductsByCategory(category);
  });
});


    // Search Functionality
    document.getElementById("search-input").addEventListener("input", function() {
      const keyword = this.value.toLowerCase();
      const products = document.querySelectorAll(".produk");

      products.forEach(function(produk) {
        const title = produk.querySelector("h3").textContent.toLowerCase();
        if (title.includes(keyword)) {
          produk.style.display = "block";
        } else {
          produk.style.display = "none";
        }
      });
    });

    function filterProductsByCategory(category) {
  const products = document.querySelectorAll('.produk');

  products.forEach(product => {
    if (category === 'all') {
      product.style.display = 'block';
    } else {
      const productCategory = product.dataset.category.toLowerCase();
      product.style.display = productCategory === category.toLowerCase() ? 'block' : 'none';
    }
  });
}

  </script>
</body>
</html>
