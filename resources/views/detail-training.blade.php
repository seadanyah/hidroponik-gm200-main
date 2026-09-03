@include('layouts.onboarding.header')
<style>
    .input-modern {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .input-modern:focus {
        outline: none;
        border-color: #10b981;
        background: white;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    /* ANIMASI */
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-scaleIn {
        animation: scaleIn 0.25s ease;
    }
</style>
<main class="pt-32 pb-24 px-6 relative min-h-screen">
    <div id="modalDaftar" class="fixed inset-0 z-[9999] hidden flex items-center justify-center">

        <!-- BACKDROP -->
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm z-10" onclick="closeModal()"></div>

        <!-- MODAL -->
        <div class="relative z-20 bg-white/90 backdrop-blur-xl w-full max-w-md p-8 rounded-3xl shadow-2xl">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
                ✕
            </button>
            <!-- HEADER -->
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-extrabold text-gray-900">Form Pendaftaran</h2>
                <p class="text-sm text-gray-500 mt-1">Isi data dengan benar ya 👇</p>
            </div>

            <form id="formPelatihan" class="space-y-4">

                <input type="hidden" id="training_id" value="{{ $data->id }}">

                <!-- INPUT -->
                <div class="space-y-3">

                    <input type="text" id="nama" placeholder="Nama Lengkap" class="input-modern">

                    <input type="email" id="email" placeholder="Email" class="input-modern">

                    <input type="text" id="phone" placeholder="No HP" class="input-modern">

                    <input type="text" id="pekerjaan" placeholder="Pekerjaan" class="input-modern">

                    <input type="text" id="institusi" placeholder="Institusi" class="input-modern">
                </div>

                <!-- BUTTON -->
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()"
                        class="w-1/2 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 font-semibold transition">
                        Batal
                    </button>

                    <button type="submit"
                        class="w-1/2 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold shadow-lg hover:shadow-xl transition-all">
                        Daftar
                    </button>
                </div>

            </form>
        </div>
    </div>
    <!-- Ambient Light Glows -->
    <div class="glow-blob bg-emerald-100 w-[500px] h-[500px] top-0 left-0"></div>
    <div class="glow-blob bg-teal-50 w-[600px] h-[600px] bottom-0 right-0"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8 font-medium">
            <a href="/pelatihan" class="hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <span class="text-gray-300 hidden sm:inline">/</span>
            <span class="text-gray-900 font-bold truncate hidden sm:inline">{{ $data->title }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <!-- Kolom Kiri: Detail Konten (Span 8) -->
            <div class="lg:col-span-8">

                <!-- Header Visual -->
                <div
                    class="rounded-[2rem] overflow-hidden mb-10 shadow-lg border border-gray-100 relative h-[300px] md:h-[450px]">
                    <div class="absolute inset-0 bg-gray-900/10 z-10"></div>
                    <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}"
                        class="w-full h-full object-cover relative z-0">

                </div>

                <!-- Judul & Meta -->
                <div class="pb-2 border-b border-gray-100">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">{{ $data->title }}
                    </h1>
                    <p class="text-lg text-gray-500 mb-6 leading-relaxed">{{ $data->description }}</p>
                </div>


            </div>

            <!-- Kolom Kanan: Sticky Sidebar Pendaftaran (Span 4) -->
            <div class="lg:col-span-4 relative">
                <!-- Gunakan top-28 agar tidak tertutup navbar saat sticky -->
                <div class="lg:sticky lg:top-28">

                    <!-- Kartu Informasi & Harga -->
                    <div class="glass-card rounded-[2rem] p-6 shadow-xl ">

                        <!-- Harga -->
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-500 mb-1">Informasi Pendaftaran</p>
                        </div>

                        <!-- Detail Jadwal -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 shrink-0">
                                    <i class="fa-regular fa-calendar text-emerald-500"></i>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold text-gray-900">Tanggal</h5>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::setLocale('id') }}
                                        {{ \Carbon\Carbon::parse($data->date)->translatedFormat('l, d F Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 shrink-0">
                                    <i class="fa-regular fa-clock text-emerald-500"></i>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold text-gray-900">Waktu Pelaksanaan</h5>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($data->time)->format('H.i') }} WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 shrink-0">
                                    <i class="fa-solid fa-location-dot text-emerald-500"></i>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold text-gray-900">Lokasi Pelatihan</h5>
                                    <p class="text-sm text-gray-600 leading-tight">{{ $data->location }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar Kuota -->
                        @php
                            $quota = $data->quota;
                            $sisa = $quota - $booked;
                            $percent = $quota > 0 ? ($booked / $quota) * 100 : 0;
                        @endphp

                        <div class="mb-6 bg-red-50/50 p-4 rounded-xl border border-red-100">

                            <!-- HEADER -->
                            <div class="flex justify-between w-full text-xs font-bold mb-2">
                                <span class="text-gray-700">Kuota Terisi</span>

                                <span class="{{ $sisa <= 5 ? 'text-red-600' : 'text-emerald-600' }}">
                                    Sisa {{ $sisa }} kursi
                                </span>
                            </div>

                            <!-- PROGRESS BAR -->
                            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full
            {{ $sisa <= 5 ? 'bg-red-500' : 'bg-emerald-500' }}
            rounded-full transition-all duration-500"
                                    style="width: {{ $percent }}%">
                                </div>
                            </div>

                        </div>

                    </div>
                    @php
                        $phone = preg_replace('/^0/', '62', $admin->phone ?? '');
                        $message = urlencode('Halo admin, saya ingin bertanya 🙏');
                    @endphp
                    <!-- Card Bantuan -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500">Ada pertanyaan tentang kelas ini?</p>
                        <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                            class="inline-flex items-center gap-2 text-sm font-bold text-emerald-600 hover:text-emerald-700 mt-1">
                            <i class="fa-brands fa-whatsapp"></i> Tanya Admin (CS)
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($sisa <= 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-7">
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
                        <p class="font-bold">Kuota Penuh</p>
                        <p>Maaf, kuota untuk pelatihan ini sudah penuh.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                <div class="lg:col-span-7">
                    <form action="{{ route('pelatihan.daftar', $data->id) }}" method="POST" class="space-y-8">
                        @csrf
                        <!-- Section 1: Informasi Kontak -->
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
                                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama
                                        Lengkap
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative input-group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i
                                                class="fa-regular fa-user text-gray-400 input-icon transition-colors"></i>
                                        </div>
                                        <input type="text" value="{{ old('name') }}" id="name"
                                            name="name" required placeholder="Contoh: Budi Santoso"
                                            class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Field: Phone -->
                                    <div>
                                        <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">No.
                                            WhatsApp <span class="text-red-500">*</span></label>
                                        <div class="relative input-group">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i
                                                    class="fa-brands fa-whatsapp text-gray-400 input-icon transition-colors"></i>
                                            </div>
                                            <input type="number" value="{{ old('phone') }}" id="phone"
                                                name="phone" required placeholder="0812xxxx"
                                                class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                        </div>
                                    </div>

                                    <!-- Field: Email -->
                                    <div>
                                        <label for="email"
                                            class="block text-sm font-bold text-gray-700 mb-2">Alamat
                                            Email <span class="text-red-500">*</span></label>
                                        <div class="relative input-group">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i
                                                    class="fa-regular fa-envelope text-gray-400 input-icon transition-colors"></i>
                                            </div>
                                            <input type="email" value="{{ old('email') }}" id="email"
                                                name="email" required placeholder="email@contoh.com"
                                                class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Alamat & Catatan -->
                        <div class="bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm">
                            <h3
                                class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3 border-b border-gray-100 pb-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm"><i
                                        class="fa-solid fa-location-dot"></i></span>
                                Informasi Diri
                            </h3>

                            <div class="space-y-5">
                                <!-- Field: Address (Textarea) -->
                                <div>
                                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative input-group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i
                                                class="fa-solid fa-briefcase text-gray-400 input-icon transition-colors"></i>
                                        </div>
                                        <input type="text" value="{{ old('pekerjaan') }}" id="pekerjaan"
                                            name="pekerjaan" required placeholder="Ibu Rumah Tangga"
                                            class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                    </div>
                                </div>

                                <!-- Field: Note (Textarea) -->
                                <div>
                                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Institusi
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative input-group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i
                                                class="fa-solid fa-building text-gray-400 input-icon transition-colors"></i>
                                        </div>
                                        <input type="text" value="{{ old('institusi') }}" id="institusi"
                                            name="institusi" required placeholder="- jika tidak memmiliki"
                                            class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button (Mobile Only - Hidden on Desktop) -->
                        <div class="lg:hidden">
                            <button type="submit" form="checkoutForm" id="mobileSubmitBtn"
                                class="w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all shadow-[0_4px_15px_rgba(16,185,129,0.3)] flex items-center justify-center gap-2">
                                <span class="btnText">Daftar Pelatihan</span>
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
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="lg:sticky lg:top-28">
                        <div class="glass-card rounded-[2rem] p-6 shadow-xl">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Daftar Pelatihan</h3>
                            @if ($data->date > \Carbon\Carbon::now())
                                <!-- Submit Button (Desktop) -->
                                <button type="submit" id="desktopSubmitBtn"
                                    onclick="return confirm('Yakin ingin daftar pelatihan?')"
                                    class="hidden lg:flex w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all shadow-[0_4px_15px_rgba(16,185,129,0.3)] hover:shadow-[0_8px_20px_rgba(16,185,129,0.4)] hover:-translate-y-0.5 items-center justify-center gap-2">
                                    <span class="btnText">Daftar Pelatihan</span>
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
                            @else
                                <button disabled
                                    class="w-full py-4 rounded-xl bg-gray-300 text-gray-600 font-bold cursor-not-allowed flex items-center justify-center gap-2">
                                    <span class="btnText">Pendaftaran Ditutup</span>
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            @endif
                            </form>
                            <p
                                class="text-center text-[10px] text-gray-400 mt-4 flex justify-center items-center gap-1">
                                <i class="fa-solid fa-lock text-emerald-500"></i> Data Anda dilindungi dan dienkripsi.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

</main>


<!-- Toast Container -->
<div id="toastContainer"
    class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[100] flex flex-col gap-2 pointer-events-none"></div>


@include('layouts.onboarding.footer')
