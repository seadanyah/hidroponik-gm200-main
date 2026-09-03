@include('layouts.onboarding.header')


<section id="home" class="relative min-h-screen flex items-center pt-24 px-6 overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full">

        <div class="reveal relative z-10">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 text-sm font-semibold mb-6">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                100% Bebas Pestisida & Alami
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold leading-[1.1] mb-6 text-gray-900">
                Sayuran <span class="text-gradient">Hidroponik</span> Terbaik di Jember.
            </h1>
            <p class="text-gray-600 text-lg md:text-xl mb-8 leading-relaxed max-w-lg">
                Nikmati hasil panen sayuran hidroponik paling segar untuk keluarga Anda, dan ikuti pelatihan di sini!
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/produk"
                    class="px-8 py-4 rounded-full bg-emerald-500 text-white font-bold hover:bg-emerald-600 hover:shadow-[0_8px_20px_rgba(16,185,129,0.3)] transition-all text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-cart-shopping"></i> Beli Sayuran
                </a>
                <a href="/pelatihan"
                    class="px-8 py-4 rounded-full bg-white border-2 border-emerald-100 text-emerald-600 font-bold hover:border-emerald-500 hover:bg-emerald-50 transition-all text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-graduation-cap"></i> Ikuti Pelatihan
                </a>
            </div>
        </div>

        <div class="relative h-[500px] hidden lg:flex justify-center items-center">
            <div
                class="relative w-[400px] h-[400px] rounded-full bg-gradient-to-tr from-emerald-100 to-emerald-300 p-2 animate-float">
                <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Sayuran Hidroponik"
                    class="w-full h-full object-cover rounded-full border-4 border-white shadow-2xl">
            </div>

            <div class="absolute top-10 -left-10 glass-card p-5 rounded-2xl w-48 animate-float-delayed z-20">
                <div class="flex items-center gap-3 mb-2">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <span class="text-sm font-bold text-gray-500">Panen Harian</span>
                </div>
                <div class="text-3xl font-extrabold text-gray-900">50+ Kg</div>
            </div>

            <div class="absolute bottom-10 -right-10 glass-card p-5 rounded-2xl w-56 animate-float z-20">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="text-sm font-bold text-gray-500">Alumni Pelatihan</span>
                </div>
                <div class="text-3xl font-extrabold text-gray-900">1.200+</div>
                <div class="text-xs font-semibold text-emerald-500 mt-1"><i class="fa-solid fa-arrow-trend-up"></i>
                    Petani Sukses</div>
            </div>
        </div>
    </div>
</section>

<section id="tentang-kami" class="py-24 px-6 bg-white relative">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative reveal order-2 lg:order-1">
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1591857177580-dc82b9ac4e1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Kebun Hidroponik" class="rounded-3xl w-full h-64 object-cover shadow-lg">
                    <img src="https://images.unsplash.com/photo-1528698827591-e19ccd7bc23d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Pelatihan Hidroponik" class="rounded-3xl w-full h-64 object-cover shadow-lg mt-8">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-full shadow-2xl">
                    <i class="fa-solid fa-seedling text-5xl text-emerald-500"></i>
                </div>
            </div>

            <div class="reveal order-1 lg:order-2">
                <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Tentang GM 200
                </h2>
                <h3 class="text-3xl md:text-5xl font-extrabold mb-6 text-gray-900">Lebih Dari Sekadar <span
                        class="text-gradient">Kebun.</span></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                    GM 200 hadir sebagai ekosistem pertanian modern yang tidak hanya memproduksi sayuran hidroponik
                    berkualitas tinggi, tetapi juga memberdayakan masyarakat melalui edukasi.
                </p>
                <p class="text-gray-600 mb-8 leading-relaxed text-lg">
                    Kami percaya bahwa makanan sehat berawal dari cara tanam yang benar. Oleh karena itu, kami
                    membuka pintu kebun kami untuk Anda belajar langsung praktiknya.
                </p>

                <div class="space-y-5">
                    <div class="bg-emerald-50 p-5 rounded-2xl flex items-start gap-4 border border-emerald-100">
                        <div
                            class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-emerald-500 shrink-0 text-xl">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">Hasil Panen Premium</h4>
                            <p class="text-sm text-gray-600">Sayuran lebih renyah, bersih, dan kaya nutrisi karena
                                ditanam di lingkungan yang terkontrol.</p>
                        </div>
                    </div>
                    <div class="bg-blue-50 p-5 rounded-2xl flex items-start gap-4 border border-blue-100">
                        <div
                            class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-blue-500 shrink-0 text-xl">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">Pusat Edukasi & Pelatihan</h4>
                            <p class="text-sm text-gray-600">Program mentoring lengkap dari pemula hingga skala
                                komersial oleh praktisi ahli.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="produk" class="py-24 px-6 relative bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 reveal">
            <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Katalog Sayuran</h2>
            <h3 class="text-3xl md:text-5xl font-extrabold mb-4 text-gray-900">Panen <span class="text-gradient">Segar
                    Hari Ini</span></h3>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Diantar langsung dari kebun kami ke meja makan Anda.
                Bebas pestisida dan dipanen di hari yang sama.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach ($data as $item)
                <a href="{{ route('produk.show', $item->id) }}" class="block group">

                    <div
                        class="bg-white rounded-3xl overflow-hidden shadow border hover:-translate-y-2 transition cursor-pointer">

                        <div class="h-56 overflow-hidden relative p-4 bg-emerald-50">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-full h-full object-cover rounded-2xl group-hover:scale-105 transition">

                            @if ($loop->first)
                                <div
                                    class="absolute top-6 right-6 bg-emerald-500 text-white text-xs px-3 py-1 rounded-full">
                                    Terlaris
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-1">
                                {{ $item->name }}
                            </h4>

                            <p class="text-sm text-gray-500 mb-4">
                                {{ $item->description }}
                            </p>

                            <div class="flex items-center justify-between mt-4 pt-4 border-t">
                                <div>
                                    <span class="text-xl font-extrabold text-emerald-600">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        / {{ $item->unit }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach

        </div>
    </div>
</section>

<section id="pelatihan" class="py-24 px-6 relative bg-white">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

        <div class="lg:col-span-12 reveal">
            <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Pelatihan GM 200</h2>
            <h3 class="text-3xl md:text-5xl font-extrabold mb-6 text-gray-900">Mulai <span class="text-gradient">Kebun
                    Impianmu</span></h3>
            <p class="text-gray-600 mb-8 text-lg">Dari menyemai benih hingga strategi penjualan. Ikuti kelas tatap
                muka atau kelas online interaktif bersama mentor berpengalaman kami.</p>

            <div class="space-y-4">
                @foreach ($pelatihan as $item)
                    <div
                        class="glass-card p-6 rounded-2xl flex flex-col sm:flex-row justify-between items-center gap-4 relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-2 bg-emerald-500"></div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $item->title }}
                            </h4>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1"><i
                                        class="fa-regular fa-calendar text-emerald-500"></i>
                                    {{ \Carbon\Carbon::setLocale('id') }}
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}</span>
                                <span class="flex items-center gap-1"><i
                                        class="fa-solid fa-location-dot text-emerald-500"></i>{{ $item->location }}</span>
                            </div>
                        </div>
                        <a href="/pelatihan/{{ $item->id }}"
                            class="w-full sm:w-auto px-6 py-3 bg-gray-900 hover:bg-emerald-500 text-white font-bold rounded-xl transition-colors whitespace-nowrap">Daftar</a>
                    </div>
                @endforeach

            </div>
        </div>


    </div>
</section>

<section id="artikel" class="py-24 px-6 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-12 reveal">
            <div>
                <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Pojok Baca</h2>
                <h3 class="text-3xl font-extrabold text-gray-900">Tips & Trik <span
                        class="text-gradient">Pertanian</span></h3>
            </div>
            <a href="/artikel"
                class="hidden sm:inline-flex items-center gap-2 font-bold text-emerald-600 hover:text-emerald-700">Lihat
                Semua <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($artikel as $item)
                <a href="/artikel/{{ \Illuminate\Support\Str::slug($item->title) }}"
                    class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 group cursor-pointer reveal">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="Nutrisi">
                    </div>
                    <div class="p-6">
                        <h4
                            class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors">
                            {{ $item->title }}</h4>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                            {{ Str::limit(strip_tags($item->content), 150) }} </p>
                    </div>
                </a>
            @endforeach

        </div>

        <div class="mt-8 text-center sm:hidden">
            <button
                class="px-6 py-3 bg-white border-2 border-emerald-500 text-emerald-600 font-bold rounded-full">Lihat
                Semua Artikel</button>
        </div>
    </div>
</section>
<section id="ulasan" class="py-24 px-6 relative bg-white border-t border-gray-100 overflow-hidden">
    <div
        class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2">
    </div>
    <div
        class="absolute bottom-0 left-0 w-64 h-64 bg-teal-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-x-1/2 translate-y-1/2">
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-16 reveal">
            <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Kata Mereka</h2>
            <h3 class="text-3xl md:text-5xl font-extrabold mb-4 text-gray-900">Dipercaya oleh <span
                    class="text-gradient">Pelanggan Kami</span></h3>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Dari ibu rumah tangga hingga pengusaha komersial, lihat
                apa yang mereka katakan tentang kualitas dan layanan GM 200.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($review as $item)
                <div class="glass-card p-8 rounded-3xl reveal group cursor-default" style="transition-delay: 0ms;">
                    <div
                        class="flex text-yellow-400 text-sm mb-6 gap-1 group-hover:scale-105 transform origin-left transition-transform duration-300">

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $item->rating)
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor

                    </div>
                    <p class="text-gray-700 italic mb-8 leading-relaxed">"{{ $item->review }}"</p>
                    <div class="flex items-center gap-4 mt-auto">
                        <div>
                            <div
                                class="text-base font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">
                                {{ $item->name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12 reveal" style="transition-delay: 400ms;">
            <p class="text-gray-500 font-medium">Berdasarkan ulasan dari <span class="font-bold text-gray-900"><i
                        class="text-emerald-500 mr-1"></i>Layanan Kami</span></p>
        </div>
    </div>
</section>
<section class="py-24 px-6 relative bg-white">
    <div
        class="max-w-5xl mx-auto text-center bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-100 p-12 md:p-20 rounded-[3rem] reveal shadow-lg">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-gray-900">Siap Makan Sehat & <span
                class="text-gradient">Jadi Petani Modern?</span></h2>
        <p class="text-gray-600 text-lg mb-10 max-w-2xl mx-auto">
            Pesan sayuran segar kami untuk menu harianmu, atau ikuti kelas pelatihan kami di Jember untuk memulai
            kebun pertamamu.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/produk"
                class="px-8 py-4 rounded-full bg-emerald-500 text-white font-bold hover:bg-emerald-600 shadow-md hover:shadow-lg transition-all">
                Pesan Sayuran Sekarang
            </a>
            @php
                $phone = preg_replace('/^0/', '62', $admin->phone ?? '');
                $message = urlencode('Halo admin, saya ingin bertanya 🙏');
            @endphp

            <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                class="px-8 py-4 rounded-full bg-white text-gray-900 font-bold hover:bg-gray-50 border border-gray-200 shadow-sm transition-all">
                Tanya Admin
            </a>
        </div>
    </div>
</section>


@include('layouts.onboarding.footer')
