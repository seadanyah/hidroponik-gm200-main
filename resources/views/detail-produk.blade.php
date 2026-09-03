@include('layouts.onboarding.header')
<style>
    body {
        background-color: #FAFAFA;
        color: #1F2937;
        overflow-x: hidden;
    }

    /* Light Glassmorphism */
    .glass-nav {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .glass-card {
        background: #ffffff;
        border: 1px solid #f3f4f6;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hover Zoom Image */
    .img-zoom-container {
        overflow: hidden;
    }

    .img-zoom {
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .img-zoom-container:hover .img-zoom {
        transform: scale(1.08);
    }

    /* Toast Animation */
    @keyframes slideInUp {
        from {
            transform: translate(-50%, 100%);
            opacity: 0;
        }

        to {
            transform: translate(-50%, 0);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .toast {
        animation: slideInUp 0.3s ease-out forwards;
    }

    .toast.hiding {
        animation: fadeOut 0.3s ease-in forwards;
    }

    /* Ambient Blobs */
    .glow-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        z-index: -1;
        opacity: 0.5;
    }

    /* Hide number input arrows */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<main class="pt-32 pb-24 px-6 relative min-h-screen">

    <div class="glow-blob bg-emerald-100 w-[500px] h-[500px] top-0 left-0"></div>
    <div class="glow-blob bg-teal-50 w-[600px] h-[600px] bottom-0 right-0"></div>

    <div class="max-w-6xl mx-auto relative z-10">


        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8 font-medium">
            <a href="/produk" class="hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
            </a>
            <span class="text-gray-300">|</span>
            <span class="text-gray-300">/</span>
            <span class="text-gray-900 font-bold">{{ $product->name }}</span>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-16">


            <div class="lg:col-span-5 relative">
                <div class="glass-card rounded-[2.5rem] p-4 bg-white/50 backdrop-blur-xl border border-white">
                    <div
                        class="relative w-full aspect-square rounded-[2rem] bg-emerald-50 overflow-hidden img-zoom-container cursor-crosshair shadow-inner">
                        <div
                            class="absolute top-4 left-4 z-10 bg-emerald-500 text-white text-xs font-extrabold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1.5">
                            <i class="fa-solid fa-sparkles"></i> Panen Hari Ini
                        </div>

                        <div class="absolute inset-0 flex items-center justify-center text-gray-200">
                            <i class="fa-solid fa-image text-6xl"></i>
                        </div>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover img-zoom relative z-10">
                    </div>
                </div>
            </div>


            <div class="lg:col-span-7 flex flex-col justify-center h-full pt-4 lg:pt-0">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2 leading-tight" id="productName">
                    {{ $product->name }}</h1>

                <div class="flex items-end gap-3 mb-6">
                    <span class="text-4xl md:text-5xl font-extrabold text-emerald-600 tracking-tight"
                        id="productPrice">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="text-gray-400 font-medium pb-1.5">/ {{ $product->unit }}</span>
                </div>


                <div class="flex flex-wrap gap-3 mb-8">
                    <div
                        class="px-4 py-2 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-bold flex items-center gap-2">
                        <i class="fa-solid fa-box text-emerald-500"></i> Stok: <span
                            id="stockCount">{{ $product->stock }}</span>
                    </div>
                    <div
                        class="px-4 py-2 rounded-xl bg-blue-50 border border-blue-100 text-blue-700 text-sm font-bold flex items-center gap-2">
                        <i class="fa-solid fa-check-circle text-blue-500"></i> Bebas Pestisida Kimia
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8 mb-8">
                    <h3 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider mb-3">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        {{ $product->description }}
                    </p>
                </div>


                <div class="flex flex-col sm:flex-row gap-4 mt-auto">


                    <div
                        class="flex items-center bg-gray-50 border border-gray-200 rounded-2xl h-14 w-full sm:w-36 shrink-0">
                        <button onclick="updateQty(-1)"
                            class="w-12 h-full flex items-center justify-center text-gray-500 hover:text-emerald-600 transition-colors">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" id="qtyInput" value="{{ $product->min_order }}" min="{{ $product->min_order }}" max="{{ $product->stock }}"
                            class="w-full border-none text-center bg-transparent font-bold text-gray-900 outline-none"
                            readonly>
                        <button onclick="updateQty(1)"
                            class="w-12 h-full flex items-center justify-center text-gray-500 hover:text-emerald-600 transition-colors">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>


                    <button onclick="addToCart()"
                        class="flex-1 h-14 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold flex items-center justify-center gap-2 transition-all shadow-[0_4px_15px_rgba(16,185,129,0.3)] hover:shadow-[0_8px_25px_rgba(16,185,129,0.4)] hover:-translate-y-0.5">
                        <i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang
                    </button>

                    @php
                        $phone = preg_replace('/^0/', '62', $admin->phone ?? '');
                        $message = urlencode('Halo admin, saya ingin bertanya 🙏');
                    @endphp


                    <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                        class="h-14 px-6 rounded-2xl bg-white border-2 border-emerald-100 text-emerald-600 font-bold flex items-center justify-center gap-2 hover:border-emerald-500 hover:bg-emerald-50 transition-all">
                        <i class="fa-brands fa-whatsapp text-lg"></i> <span class="hidden sm:inline">Tanya CS</span>
                    </a>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-10 border-t border-gray-100">
            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                <div
                    class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0 text-xl">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-1">Tanpa Pestisida Kimia</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Ditanam secara hidroponik bersih tanpa paparan
                        bahan kimia berbahaya, aman untuk keluarga.</p>
                </div>
            </div>


            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                <div
                    class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 shrink-0 text-xl">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-1">Fresh Delivery</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Langsung dari greenhouse ke meja makan Anda di hari
                        yang sama untuk kesegaran maksimal.</p>
                </div>
            </div>


            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                <div
                    class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 shrink-0 text-xl">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-1">Kualitas Premium</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Disortir ketat. Hanya hasil panen dengan daun utuh
                        dan bobot terbaik yang dikirim ke pelanggan.</p>
                </div>
            </div>

        </div>

    </div>
</main>

<script>
    const maxStock = {{ $product->stock }};
    const minOrder = {{ $product->min_order }};

    // tambah kuantity
    function updateQty(change) {
        let input = document.getElementById('qtyInput');
        if (!input) return;

        let value = parseInt(input.value) || minOrder;
        value += (change * minOrder);
        if (value < minOrder) {
            value = minOrder;
        }
        if (value > maxStock) {
            alert("Stok tidak mencukupi!");
            value = maxStock;
        }

        input.value = value;
    }
</script>

@include('layouts.onboarding.footer')
