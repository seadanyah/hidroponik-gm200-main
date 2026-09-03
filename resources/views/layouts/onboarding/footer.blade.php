    <footer class="bg-gray-900 border-t border-gray-800 pt-16 pb-8 px-6 mt-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-between gap-12 mb-12">
            <div>
                <a href="#" class="text-2xl font-extrabold flex items-center gap-2 mb-6">
                    <i class="fa-solid fa-leaf text-emerald-500"></i>
                    <span class="text-white">GM <span class="text-emerald-500">200</span></span>
                </a>
                @php
                    $admin = \App\Models\User::where('role', 'admin')->first();

                    $phone = preg_replace('/^0/', '62', $admin->phone ?? '');
                    $message = urlencode('Halo admin, saya ingin bertanya 🙏');
                @endphp

                <p class="text-gray-400 text-sm mb-6 leading-relaxed">Menyediakan sayuran hidroponik premium dan pusat
                    pelatihan pertanian modern untuk gaya hidup sehat dan mandiri.</p>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-emerald-500 transition-all"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-emerald-500 transition-all"><i
                            class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-emerald-500 transition-all"><i
                            class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6">Navigasi</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-emerald-400 transition-colors">Beranda</a></li>
                    <li><a href="/tentang-kami" class="hover:text-emerald-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="/produk" class="hover:text-emerald-400 transition-colors">Katalog Sayuran</a></li>
                    <li><a href="/artikel" class="hover:text-emerald-400 transition-colors">Blog & Edukasi</a></li>
                    <li><a href="/Pelatihan" class="hover:text-emerald-400 transition-colors">Pelatihan</a></li>
                </ul>
            </div>


            <div id="contact">
                <h4 class="text-white font-bold mb-6">Kontak Kami</h4>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot mt-1 text-emerald-500"></i>
                        <span>Jember, Jawa Timur<br>Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-emerald-500"></i>
                        <a href="mailto:halo@gm200.id" class="hover:text-emerald-400">halo@gm200.id</a>
                    </li>

                    <li class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-emerald-500"></i>

                        @if ($admin)
                            <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                                class="hover:text-emerald-600 transition">
                                {{ $admin->phone }}
                            </a>
                        @else
                            <span class="text-gray-400">Admin belum tersedia</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>&copy; 2026 GM 200 Hydroponics. Hak Cipta Dilindungi.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>
    <div id="floatingCart"
        class="fixed bottom-6 left-6 bg-emerald-500 text-white px-5 py-3 rounded-full shadow-lg hidden cursor-pointer">

        🛒 <span id="cartCount">0</span> item
    </div>
    </body>
    <script>
        // keranjang
        let isCartOpen = false;

        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
        }



        // tambah ke keranjang
        function addToCart() {
            let qtyInput = document.getElementById('qtyInput');
            if (!qtyInput) return;

            let qty = parseInt(qtyInput.value);
            let cart = getCart();

            let product = {
                id: {{ isset($product) ? $product->id : 'null' }},
                name: "{{ isset($product) ? $product->name : '' }}",
                price: {{ isset($product) ? $product->price : 0 }},
                qty: qty,
                image: "{{ isset($product) && $product->image ? asset('storage/' . $product->image) : '' }}",
                min_order: {{ isset($product) ? $product->min_order : 1 }}
            };

            // produk ada di halaman lain
            if (!product.id) return;

            let existing = cart.find(item => item.id === product.id);

            if (existing) {
                // Pastikan penambahan juga mengikuti kelipatan jika ditambahkan lagi dari halaman produk
                existing.qty += product.min_order;
            } else {
                cart.push(product);
            }

            saveCart(cart);
            renderCart();
        }

        // floating kiri
        document.addEventListener("DOMContentLoaded", function() {
            renderCart();

            let floatingBtn = document.getElementById('floatingCart');
            if (floatingBtn) {
                floatingBtn.onclick = toggleCart;
            }
        });

        function toggleCart() {
            let overlay = document.getElementById('cartOverlay');
            let backdrop = document.getElementById('cartBackdrop');
            let floating = document.getElementById('floatingCart');

            if (!overlay) return;

            isCartOpen = !isCartOpen;

            if (isCartOpen) {
                overlay.classList.remove('w-0');
                overlay.classList.add('w-[350px]');

                backdrop.classList.remove('hidden');

                if (floating) floating.classList.add('hidden');
            } else {
                overlay.classList.remove('w-[350px]');
                overlay.classList.add('w-0');

                backdrop.classList.add('hidden');

                if (floating) floating.classList.remove('hidden');
            }
        }

        // tampil keranjang
        // tampil keranjang
        function renderCart() {
            let container = document.getElementById('cartItems');
            let countEl = document.getElementById('cartCount');
            let totalEl = document.getElementById('cartTotal');
            let floating = document.getElementById('floatingCart');

            let cart = getCart();

            // update jumlah item
            if (countEl) countEl.innerText = cart.length;

            if (floating) {
                if (isCartOpen) {
                    floating.classList.add('hidden');
                } else {
                    if (cart.length > 0) {
                        floating.classList.remove('hidden');
                    } else {
                        floating.classList.add('hidden');
                    }
                }
            }
            if (!container) return;

            let total = 0;
            container.innerHTML = '';

            cart.forEach((item, index) => {
                total += item.price * item.qty;

                // ---> PERUBAHAN ADA DI SINI <---
                // Menambahkan tag <img> dan sedikit penyesuaian tata letak (flex, gap) agar rapi
                container.innerHTML += `
            <div class="flex justify-between items-center border-b pb-3 pt-2 gap-2">
                <div class="flex items-center gap-3">
                    <img src="${item.image}" alt="${item.name}" class="w-12 h-12 rounded-lg object-cover bg-gray-100">
                    <div>
                        <p class="font-bold text-gray-800">${item.name}</p>
                        <p class="text-sm text-emerald-600 font-semibold">Rp ${formatRupiah(item.price)}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="changeQty(${index}, -1)" class="w-7 h-7 rounded-full bg-gray-100 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-colors font-bold">-</button>
                    <span class="w-4 text-center font-medium">${item.qty}</span>
                    <button onclick="changeQty(${index}, 1)" class="w-7 h-7 rounded-full bg-emerald-50 hover:bg-emerald-500 hover:text-white flex items-center justify-center text-emerald-600 transition-colors font-bold">+</button>
                </div>
            </div>
            `;
            });

            if (totalEl) totalEl.innerText = "Rp " + formatRupiah(total);
        }

        // ubah jumlah di keranjang
        // ubah jumlah di keranjang
        function changeQty(index, direction) {
            let cart = getCart();
            let item = cart[index];

            // Ambil nilai min_order produk, gunakan 1 sebagai fallback jika tidak ada
            let minOrder = item.min_order || 1;

            // Jika direction 1 (tambah), tambah sebanyak min_order
            // Jika direction -1 (kurang), kurangi sebanyak min_order
            if (direction === 1) {
                item.qty += minOrder;
            } else if (direction === -1) {
                item.qty -= minOrder;
            }

            // Jika qty kurang dari atau sama dengan 0, hapus dari keranjang
            if (item.qty <= 0) {
                cart.splice(index, 1);
            }

            saveCart(cart);
            renderCart();
        }

        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID');
        }

        document.addEventListener("DOMContentLoaded", function() {
            renderCart();
        });


        let navbar = document.getElementById('navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    navbar.classList.add('bg-white/90', 'shadow-md');
                    navbar.classList.remove('bg-white/50', 'border-transparent');
                } else {
                    navbar.classList.remove('bg-white/90', 'shadow-md');
                }
            });
        }

        const revealElements = document.querySelectorAll('.reveal');

        if (revealElements.length > 0) {
            const revealOptions = {
                threshold: 0.15,
                rootMargin: "0px 0px -50px 0px"
            };

            const revealOnScroll = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, revealOptions);

            revealElements.forEach(el => {
                revealOnScroll.observe(el);
            });
        }
    </script>

    </html>
