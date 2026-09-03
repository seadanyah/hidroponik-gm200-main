@include('layouts.onboarding.header')
<main class="pt-28 pb-24 px-6 relative min-h-screen">

    <div class="glow-blob bg-emerald-100 w-[400px] h-[400px] top-0 left-0"></div>
    <div class="glow-blob bg-teal-50 w-[500px] h-[500px] bottom-0 right-0"></div>


    <div class="max-w-6xl mx-auto relative z-10">

        <div id="successOverlay" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-[9999]">
            <div class="bg-white p-8 rounded-2xl text-center max-w-sm w-full">
                <h2 class="text-xl font-bold mb-2">Pesanan Berhasil 🎉</h2>
                <p class="text-gray-500 mb-4">Anda akan diarahkan ke WhatsApp...</p>

                <div class="animate-spin mx-auto w-6 h-6 border-2 border-emerald-500 border-t-transparent rounded-full">
                </div>
            </div>
        </div>
        <div class="mb-8">
            <a href="/produk"
                class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-emerald-600 transition-colors mb-4">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Selesaikan Pesanan Anda</h1>
            <p class="text-gray-500 mt-2">Mohon lengkapi data diri dan alamat pengiriman di bawah ini.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">


            <div class="lg:col-span-7">
                <form id="checkoutForm" onsubmit="handleCheckout(event)" class="space-y-8">


                    <div class="bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <h3
                            class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3 border-b border-gray-100 pb-4">
                            <span
                                class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm"><i
                                    class="fa-regular fa-id-badge"></i></span>
                            Informasi Kontak
                        </h3>

                        <div class="space-y-5">

                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap
                                    <span class="text-red-500">*</span></label>
                                <div class="relative input-group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-user text-gray-400 input-icon transition-colors"></i>
                                    </div>
                                    <input type="text" id="name" name="name" required
                                        placeholder="Contoh: Budi Santoso"
                                        class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">No.
                                        WhatsApp <span class="text-red-500">*</span></label>
                                    <div class="relative input-group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i
                                                class="fa-brands fa-whatsapp text-gray-400 input-icon transition-colors"></i>
                                        </div>
                                        <input type="number" id="phone" name="phone" required
                                            placeholder="0812xxxx"
                                            class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                    </div>
                                </div>


                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat
                                        Email <span class="text-red-500">*</span></label>
                                    <div class="relative input-group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i
                                                class="fa-regular fa-envelope text-gray-400 input-icon transition-colors"></i>
                                        </div>
                                        <input type="email" id="email" name="email" required
                                            placeholder="email@contoh.com"
                                            class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <h3
                            class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3 border-b border-gray-100 pb-4">
                            <span
                                class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm"><i
                                    class="fa-solid fa-location-dot"></i></span>
                            Pengiriman
                        </h3>

                        <div class="space-y-5">

                            <div>
                                <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap
                                    <span class="text-red-500">*</span></label>
                                <div class="relative input-group">
                                    <div class="absolute top-3.5 left-0 pl-4 pointer-events-none">
                                        <i class="fa-solid fa-map-pin text-gray-400 input-icon transition-colors"></i>
                                    </div>
                                    <textarea id="address" name="address" rows="3" required
                                        placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos..."
                                        class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none resize-none"></textarea>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Pastikan alamat yang Anda masukkan benar untuk
                                    menghindari kegagalan pengiriman.</p>
                            </div>


                            <div>
                                <label for="note" class="block text-sm font-bold text-gray-700 mb-2">Catatan Pesanan
                                    <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                <div class="relative input-group">
                                    <div class="absolute top-3.5 left-0 pl-4 pointer-events-none">
                                        <i
                                            class="fa-regular fa-clipboard text-gray-400 input-icon transition-colors"></i>
                                    </div>
                                    <textarea id="note" name="note" rows="2"
                                        placeholder="Contoh: Tolong pilihkan daun yang paling besar / Titip di pos satpam."
                                        class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="lg:hidden">
                        <button type="submit" form="checkoutForm" id="mobileSubmitBtn"
                            onclick="return confirm('Yakin ingin membuat pesanan?')"
                            class="w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all shadow-[0_4px_15px_rgba(16,185,129,0.3)] flex items-center justify-center gap-2">
                            <span class="btnText">Buat Pesanan</span>
                            <i class="fa-solid fa-arrow-right btnIcon"></i>
                            <svg class="btnSpinner hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="lg:sticky lg:top-28">
                    <div class="glass-card rounded-[2rem] p-6 shadow-xl">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>


                        <div class="space-y-4 mb-6">
                            <div id="checkoutItems" class="space-y-4 mb-6"></div>
                        </div>


                        <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal</span>
                                <span id="subtotal" class="font-semibold text-gray-900">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm border-t border-dashed border-gray-200 pt-3">
                                <span class="font-bold text-gray-900">Total Harga </span>
                                <span id="total" class="font-extrabold text-xl text-emerald-600">Rp 0</span>
                            </div>
                        </div>


                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 mb-6 flex gap-3 items-start">
                            <i class="fa-solid fa-circle-info text-blue-500 mt-0.5"></i>
                            <p class="text-xs text-blue-800 leading-relaxed">Pembayaran dilakukan melalui WhatsApp
                                setelah Anda melakukan pembuatan pesanan di bawah ini.</p>
                        </div>


                        <button type="submit" form="checkoutForm" id="desktopSubmitBtn"
                            class="hidden lg:flex w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all shadow-[0_4px_15px_rgba(16,185,129,0.3)] hover:shadow-[0_8px_20px_rgba(16,185,129,0.4)] hover:-translate-y-0.5 items-center justify-center gap-2">
                            <span class="btnText">Buat Pesanan</span>
                            <i class="fa-solid fa-arrow-right btnIcon"></i>
                            <svg class="btnSpinner hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>

                        <p class="text-center text-[10px] text-gray-400 mt-4 flex justify-center items-center gap-1">
                            <i class="fa-solid fa-lock text-emerald-500"></i> Data Anda dilindungi dan dienkripsi.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@php
    $admin = \App\Models\User::where('role', 'admin')->first();
    $phone = preg_replace('/^0/', '62', $admin->phone ?? '');
@endphp
<script>
    function handleCheckout(e) {
        e.preventDefault();

        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (cart.length === 0) {
            alert("Keranjang kosong!");
            return;
        }

        const data = {
            name: document.getElementById("name").value,
            phone: document.getElementById("phone").value,
            email: document.getElementById("email").value,
            address: document.getElementById("address").value,
            note: document.getElementById("note").value,
            cart: cart
        };

        fetch("/checkout", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            })
            .then(async response => {
                const res = await response.json();

                if (!response.ok) {
                    alert(res.error || "Terjadi kesalahan");
                    return;
                }

                document.getElementById("successOverlay").classList.remove("hidden");

                localStorage.removeItem("cart");

                setTimeout(() => {
                    const phoneAdmin = "{{ $phone }}";

                    const message = encodeURIComponent(
                        `Halo admin, saya telah melakukan pemesanan.\n\nID Order: ${res.order_id}`
                    );

                    window.location.href = `https://wa.me/${phoneAdmin}?text=${message}`;
                }, 2000);
            })
            .catch(err => {
                console.error(err);
                alert("Terjadi error" + (err.message ? ": " + err.message : ""));
            });
    }
    document.addEventListener("DOMContentLoaded", function() {


        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        const desktopBtn = document.getElementById("desktopSubmitBtn");
        const mobileBtn = document.getElementById("mobileSubmitBtn");

        function toggleCheckoutButton() {
            if (cart.length === 0) {
                if (desktopBtn) {
                    desktopBtn.disabled = true;
                    desktopBtn.classList.add("opacity-50", "cursor-not-allowed");
                }
                if (mobileBtn) {
                    mobileBtn.disabled = true;
                    mobileBtn.classList.add("opacity-50", "cursor-not-allowed");
                }
            } else {
                if (desktopBtn) {
                    desktopBtn.disabled = false;
                    desktopBtn.classList.remove("opacity-50", "cursor-not-allowed");
                }
                if (mobileBtn) {
                    mobileBtn.disabled = false;
                    mobileBtn.classList.remove("opacity-50", "cursor-not-allowed");
                }
            }
        }

        toggleCheckoutButton();


        const container = document.getElementById("checkoutItems");

        let subtotal = 0;

        container.innerHTML = "";

        cart.forEach(item => {
            subtotal += item.price * item.qty;

            container.innerHTML += `
            <div class="flex gap-4 items-center">
                <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden border">
<img src="${item.image}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm">${item.name}</h4>
                </div>
                <div class="text-right">
                    <p class="font-bold">Rp ${item.price}</p>
                    <p class="text-xs">x ${item.qty}</p>
                </div>
            </div>
        `;
        });

        // hitung total
        const ongkir = 0;
        const total = subtotal + ongkir;

        document.querySelector("#subtotal").innerText = "Rp " + subtotal;
        document.querySelector("#total").innerText = "Rp " + total;
    });
</script>
@include('layouts.onboarding.footer')
