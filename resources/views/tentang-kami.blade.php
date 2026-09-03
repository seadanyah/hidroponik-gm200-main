@include('layouts.onboarding.header')

<section class="relative pt-40 pb-20 px-6 overflow-hidden">
    <div class="max-w-5xl mx-auto text-center reveal">
        <div
            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 text-sm font-semibold mb-6">
            Misi & Visi Kami
        </div>
        <h1 class="text-5xl md:text-6xl font-extrabold leading-[1.2] mb-6 text-gray-900">
            Dari Benih Kecil Hingga <br> <span class="text-gradient">Revolusi Hijau.</span>
        </h1>
        <p class="text-gray-600 text-lg md:text-xl mb-12 leading-relaxed max-w-3xl mx-auto">
            GM 200 lahir dari kepedulian terhadap kualitas pangan dan masa depan pertanian. Kami tidak hanya menanam
            sayur, kami menanam pengetahuan untuk melahirkan generasi petani modern.
        </p>
    </div>

    <div class="max-w-6xl mx-auto reveal" style="transition-delay: 200ms;">
        <div class="relative rounded-[2rem] overflow-hidden shadow-2xl h-[400px] md:h-[500px]">
            <img src="{{ asset('img/tentang.jpeg') }}" alt="Kebun GM 200" class="w-full h-full object-cover">
            <div
                class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent flex flex-col justify-end p-8 md:p-12">
                <div class="flex items-center gap-4 text-white">

                    <div>
                        <p class="font-bold text-lg"> Kebun Kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 px-6 relative z-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Fondasi Utama <span class="text-gradient">GM
                    200</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card p-10 rounded-3xl reveal group cursor-pointer text-center">
                <div
                    class="w-20 h-20 mx-auto bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 text-3xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Kualitas Premium</h3>
                <p class="text-gray-600 leading-relaxed">Kami memastikan setiap helai sayur yang dipanen 100% bebas
                    pestisida, kaya nutrisi, dan terjaga kebersihannya hingga sampai di dapur Anda.</p>
            </div>

            <div class="glass-card p-10 rounded-3xl reveal group cursor-pointer text-center"
                style="transition-delay: 100ms;">
                <div
                    class="w-20 h-20 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 text-3xl mb-6 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Edukasi Terbuka</h3>
                <p class="text-gray-600 leading-relaxed">Ilmu tidak untuk disimpan sendiri. Melalui program
                    pelatihan, kami mencetak petani urban baru yang mandiri secara ekonomi dan pangan.</p>
            </div>

            <div class="glass-card p-10 rounded-3xl reveal group cursor-pointer text-center"
                style="transition-delay: 200ms;">
                <div
                    class="w-20 h-20 mx-auto bg-teal-50 rounded-2xl flex items-center justify-center text-teal-500 text-3xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                    <i class="fa-solid fa-recycle"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Keberlanjutan</h3>
                <p class="text-gray-600 leading-relaxed">Sistem hidroponik kami menghemat air hingga 90%
                    dibandingkan pertanian konvensional, menjaga kelestarian lingkungan untuk generasi esok.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 px-6 bg-[#f8fafc] border-y border-gray-100">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16 reveal">
            <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Sejarah</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Perjalanan <span
                    class="text-gradient">Kami</span></h3>
        </div>

        <div class="relative border-l-4 border-emerald-100 ml-4 md:ml-1/2 py-4">

            <div class="mb-12 relative group reveal pl-8 md:pl-12">
                <div class="timeline-dot absolute"></div>
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow">
                    <span class="text-emerald-500 font-extrabold text-xl mb-1 block">2021</span>
                    <h4 class="text-lg font-bold text-gray-900 mb-2">Berawal dari Teras Rumah</h4>
                    <p class="text-gray-600">Dimulai dari keresahan mencari sayur sehat saat pandemi. Kami membangun
                        instalasi paralon sederhana dengan 100 lubang tanam.</p>
                </div>
            </div>

            <div class="mb-12 relative group reveal pl-8 md:pl-12">
                <div class="timeline-dot absolute"></div>
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow">
                    <span class="text-emerald-500 font-extrabold text-xl mb-1 block">2023</span>
                    <h4 class="text-lg font-bold text-gray-900 mb-2">Ekspansi Greenhouse Komersial</h4>
                    <p class="text-gray-600">Permintaan terus melonjak. GM 200 meresmikan greenhouse komersial
                        seluas 1.000m² di Jember, menyuplai lebih dari 20 restoran sehat.</p>
                </div>
            </div>

            <div class="relative group reveal pl-8 md:pl-12">
                <div class="timeline-dot absolute"></div>
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow">
                    <span class="text-emerald-500 font-extrabold text-xl mb-1 block">2025 - Sekarang</span>
                    <h4 class="text-lg font-bold text-gray-900 mb-2">Mendirikan Pelatihan</h4>
                    <p class="text-gray-600">Membuka kelas pelatihan offline. Kini, GM 200 bukan hanya
                        penyedia sayur hidroponik, tetapi wadah lahirnya ratusan petani hidroponik baru di Indonesia.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 px-6 relative bg-white">
    <div class="max-w-6xl mx-auto bg-gray-900 rounded-[3rem] overflow-hidden relative reveal shadow-2xl">
        <div class="absolute inset-0 opacity-20 mix-blend-overlay">
            <img src="https://images.unsplash.com/photo-1622205313162-be1d5712a43f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                class="w-full h-full object-cover" alt="Sayuran">
        </div>

        <div class="relative z-10 p-12 md:p-20 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-white">Jadilah Bagian dari <span
                    class="text-emerald-400">Keluarga Kami.</span></h2>
            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                Apakah Anda ingin menikmati sayur berkualitas setiap hari, atau ingin belajar menjadi pengusaha
                sayur hidroponik? Kami siap mendukung langkah Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/produk"
                    class="px-8 py-4 rounded-full bg-emerald-500 text-white font-bold hover:bg-emerald-400 shadow-[0_0_20px_rgba(16,185,129,0.3)] transition-all">
                    Belanja Sayur
                </a>
                <a href="/pelatihan"
                    class="px-8 py-4 rounded-full bg-transparent border-2 border-white text-white font-bold hover:bg-white hover:text-gray-900 transition-all">
                    Ikut Pelatihan
                </a>
            </div>
        </div>
    </div>
</section>

@include('layouts.onboarding.footer')
