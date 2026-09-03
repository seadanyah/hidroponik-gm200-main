@include('layouts.onboarding.header')
<section class="pt-32 pb-12 px-6 bg-gradient-to-b from-emerald-50 to-white relative overflow-hidden">
    <div
        class="absolute top-10 left-10 w-64 h-64 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
    </div>
    <div
        class="absolute top-10 right-10 w-64 h-64 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
    </div>

    <div class="max-w-7xl mx-auto text-center relative z-10">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-gray-900">Katalog <span
                class="text-gradient">Produk</span></h1>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto text-lg">Pilih sayuran segar harianmu sendiri (Hanya di Jember
            dengan radius 10km dari lokasi GM200). <a href="https://maps.app.goo.gl/3DjiHUAwJ7Ew3i1D9" target="_blank"
                class="text-emerald-500 hover:text-emerald-600 font-medium">Lokasi</a></p>

        <div class="max-w-2xl mx-auto relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i
                    class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-emerald-500 transition-colors"></i>
            </div>
            <input type="text" id="searchInput" placeholder="Cari selada, atau packoy..."
                class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-700 bg-white shadow-sm font-medium">
        </div>
    </div>
</section>

<section class="pb-24 px-6 bg-white min-h-[50vh]">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-8">

        <div class="flex-1 w-full">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-gray-500 font-medium" id="productCount">Menampilkan <span
                        class="font-bold text-gray-900">8</span> produk</p>
                <select id="sortSelect"
                    class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block p-2 outline-none font-medium">
                    <option value="default">Urutkan: Rekomendasi</option>
                    <option value="price-asc">Harga: Rendah ke Tinggi</option>
                    <option value="price-desc">Harga: Tinggi ke Rendah</option>
                    <option value="name-asc">Nama: A - Z</option>
                </select>
            </div>

            <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            </div>

            <div id="emptyState" class="hidden text-center py-20">
                <i class="fa-solid fa-face-frown-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Oops, produk tidak ditemukan</h3>
                <p class="text-gray-500">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                <button onclick="resetFilters()"
                    class="mt-4 px-6 py-2 bg-emerald-50 text-emerald-600 font-bold rounded-lg hover:bg-emerald-100 transition-colors">Reset
                    Filter</button>
            </div>
        </div>

    </div>
</section>


<div id="toastContainer"
    class="fixed bottom-24 left-1/2 transform -translate-x-1/2 z-50 flex flex-col gap-2 pointer-events-none"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const productGrid = document.getElementById('productGrid');
        if (!productGrid) return;

        // ========================
        // DATA
        // ========================
        const productsData = {!! json_encode(
            $data->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'price' => $p->price,
                    'unit' => $p->unit,
                    'image' => asset('storage/' . $p->image),
                    'desc' => $p->description,
                    'min_order' => $p->min_order,
                ];
            }),
        ) !!};

        let currentProducts = [...productsData];

        // ========================
        // ELEMENT
        // ========================
        const emptyState = document.getElementById('emptyState');
        const productCountText = document.getElementById('productCount');
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');

        // ========================
        // FORMAT RUPIAH
        // ========================
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        };

        // ========================
        // RENDER
        // ========================
        function renderProducts(products) {
            productGrid.innerHTML = '';

            if (!products.length) {
                productGrid.classList.add('hidden');
                if (emptyState) emptyState.classList.remove('hidden');
                if (productCountText) {
                    productCountText.innerHTML =
                        `Menampilkan <span class="font-bold text-gray-900">0</span> produk`;
                }
                return;
            }

            productGrid.classList.remove('hidden');
            if (emptyState) emptyState.classList.add('hidden');
            if (productCountText) {
                productCountText.innerHTML =
                    `Menampilkan <span class="font-bold text-gray-900">${products.length}</span> produk`;
            }

            products.forEach((product, index) => {
                const delay = index * 50;

                const cardHTML = `
                <a href="/produk/${product.id}" class="glass-card rounded-3xl overflow-hidden group flex flex-col h-full"
                   style="animation: slideInUp 0.5s ease-out ${delay}ms both;">

                    <div class="h-56 overflow-hidden p-4 bg-emerald-50/50">
                        <img src="${product.image}" class="w-full h-full object-cover rounded-2xl">
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-xl font-bold">${product.name}</h4>
                        <p class="text-sm text-gray-500 mb-4">${product.desc}</p>

                        <div class="flex justify-between items-end mt-auto pt-4 border-t">
                            <div>
                                <span class="text-xl font-bold text-emerald-600">${formatRupiah(product.price)}</span>
                                <span class="text-xs text-gray-400 block">/ ${product.unit}</span>
                            </div>

                         <button onclick="addToCartFromList(${product.id}, '${product.name}', ${product.price}, '${product.image}', ${product.min_order})"
                            class="w-12 h-12 rounded-full bg-emerald-50 hover:bg-emerald-500 group-hover:bg-emerald-500 transition-colors">
                            <i class="fa-solid fa-cart-plus text-emerald-600 group-hover:text-white transition-colors"></i>
                        </button>
                        </div>
                    </div>
                </a>
            `;

                productGrid.insertAdjacentHTML('beforeend', cardHTML);
            });
        }

        // ========================
        // CART
        // ========================
        window.addToCartFromList = function(id, name, price, image, minOrder) {
            window.addToCartGlobal({
                id: id,
                name: name,
                price: price,
                image: image,
                qty: minOrder,
                min_order: minOrder
            });

            const floating = document.getElementById('floatingCart');
            if (floating) {
                floating.classList.add('scale-110');
                setTimeout(() => floating.classList.remove('scale-110'), 150);
            }
        }

        // ========================
        // FILTER
        // ========================
        function applyFilters() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const sortVal = sortSelect ? sortSelect.value : 'default';

            let filtered = productsData.filter(p =>
                p.name.toLowerCase().includes(searchTerm)
            );

            if (sortVal === 'price-asc') {
                filtered.sort((a, b) => a.price - b.price);
            } else if (sortVal === 'price-desc') {
                filtered.sort((a, b) => b.price - a.price);
            } else if (sortVal === 'name-asc') {
                filtered.sort((a, b) => a.name.localeCompare(b.name));
            }

            renderProducts(filtered);
        }

        if (searchInput) searchInput.addEventListener('input', applyFilters);
        if (sortSelect) sortSelect.addEventListener('change', applyFilters);

        // ========================
        // RESET
        // ========================
        window.resetFilters = function() {
            if (searchInput) searchInput.value = '';
            if (sortSelect) sortSelect.value = 'default';
            applyFilters();
        }

        // ========================
        // INIT
        // ========================
        renderProducts(productsData);

    });
</script>
@include('layouts.onboarding.footer')
