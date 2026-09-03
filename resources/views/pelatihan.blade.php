@include('layouts.onboarding.header')
<style>
    /* Tab Active State */
    .tab-btn.active {
        background-color: #10B981;
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        border-color: #10B981;
    }

    /* Accordion transition */
    .accordion-content {
        transition: max-height 0.4s ease-in-out, opacity 0.3s ease-in-out;
        max-height: 0;
        opacity: 0;
        overflow: hidden;
    }

    .accordion-content.open {
        max-height: 500px;
        /* Arbitrary large number */
        opacity: 1;
    }

    .accordion-icon {
        transition: transform 0.3s ease;
    }

    .accordion-item.open .accordion-icon {
        transform: rotate(180deg);
    }


    /* Toast Animation */
    /* Toast Animation (Biarkan yang ini, jangan dihapus) */
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

    /* --- TAMBAHKAN KODE INI UNTUK KARTU --- */
    @keyframes fadeUp {
        from {
            transform: translateY(40px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
<section class="relative pt-32 pb-20 px-6 overflow-hidden bg-white">
    <div
        class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-bl from-emerald-50 to-transparent rounded-bl-full z-0 opacity-70">
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
        <div class="reveal">

            <h1 class="text-5xl md:text-6xl font-extrabold leading-[1.1] mb-6 text-gray-900">
                Kuasai Ilmu <span class="text-gradient">Hidroponik</span> Langsung dari Ahli.
            </h1>
            <p class="text-gray-600 text-lg md:text-xl mb-8 leading-relaxed max-w-lg">
                Dari hobi skala rumahan hingga membangun bisnis greenhouse komersial beromzet puluhan juta. Temukan
                kelas yang tepat untuk Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#jadwal"
                    class="px-8 py-4 rounded-full bg-emerald-500 text-white font-bold hover:bg-emerald-600 hover:shadow-[0_8px_20px_rgba(16,185,129,0.3)] transition-all text-center flex items-center justify-center gap-2">
                    Lihat Jadwal Kelas
                </a>
            </div>
        </div>

        <div class="relative reveal" style="transition-delay: 200ms;">
            <div
                class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-video bg-gray-900 group cursor-pointer">
                <img src="{{ asset('img/pelatihan.jpeg') }}" alt="Video Pelatihan"
                    class="w-full h-full object-cover opacity-80 group-hover:scale-105 group-hover:opacity-60 transition-all duration-500">

            </div>
            <div
                class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 flex items-center gap-4 animate-float hidden md:flex z-20">
                <div
                    class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-500 text-xl">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Gratis!!!</p>
                    <p class="text-xs text-gray-500">Kamu bisa ikut yang sesuai minatmu!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="jadwal" class="py-24 px-6 relative bg-[#f8fafc] border-y border-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 reveal">
            <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Program Kami</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Pilih <span
                    class="text-gradient">Pelatihan</span></h3>
        </div>

        <div class="flex justify-center mb-12 reveal" style="transition-delay: 100ms;">

        </div>

        <div id="classGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 reveal"
            style="transition-delay: 200ms;">
        </div>
    </div>
</section>

<section class="py-24 px-6 bg-white relative">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16 reveal">
            <h2 class="text-sm font-extrabold text-emerald-500 tracking-wider uppercase mb-2">Materi Belajar</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Apa Saja yang Akan <span
                    class="text-gradient">Dipelajari?</span></h3>
            <p class="text-gray-600 mt-4">Silabus disusun berdasarkan praktik nyata di greenhouse komersial kami.</p>
        </div>

        <div class="space-y-5 reveal" style="transition-delay: 100ms;">

            <div
                class="accordion-item bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm transition-all duration-300 hover:shadow-md hover:border-emerald-200">
                <button
                    class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none bg-white transition-colors"
                    onclick="toggleAccordion(this)">
                    <div class="flex items-center gap-4">
                        <span
                            class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-extrabold text-sm shrink-0 border border-emerald-100">1</span>
                        <span class="font-bold text-gray-900 text-base md:text-lg">Dasar-Dasar Hidroponik & Persiapan
                            Alat</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0 ml-4">
                        <i
                            class="fa-solid fa-chevron-down text-gray-500 accordion-icon transition-transform duration-300"></i>
                    </div>
                </button>
                <div class="accordion-content bg-white border-t border-gray-100">
                    <div class="p-6 md:pl-20 text-gray-600 text-sm leading-relaxed">
                        <ul class="list-disc space-y-3 marker:text-emerald-500 pr-4">
                            <li>Pengenalan berbagai sistem hidroponik (NFT, DFT, Wick, Aeroponik).</li>
                            <li>Pengenalan alat ukur wajib (TDS meter, pH meter, Thermohygrometer).</li>
                            <li>Cara menyemai benih menggunakan rockwool dengan tingkat keberhasilan 99%.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div
                class="accordion-item bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm transition-all duration-300 hover:shadow-md hover:border-emerald-200">
                <button
                    class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none bg-white transition-colors"
                    onclick="toggleAccordion(this)">
                    <div class="flex items-center gap-4">
                        <span
                            class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-extrabold text-sm shrink-0 border border-emerald-100">2</span>
                        <span class="font-bold text-gray-900 text-base md:text-lg">Manajemen Nutrisi (Meracik AB
                            Mix)</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0 ml-4">
                        <i
                            class="fa-solid fa-chevron-down text-gray-500 accordion-icon transition-transform duration-300"></i>
                    </div>
                </button>
                <div class="accordion-content bg-white border-t border-gray-100">
                    <div class="p-6 md:pl-20 text-gray-600 text-sm leading-relaxed">
                        <ul class="list-disc space-y-3 marker:text-emerald-500 pr-4">
                            <li>Fungsi unsur makro dan mikro pada tanaman.</li>
                            <li>Praktek langsung mencairkan dan meracik nutrisi AB Mix.</li>
                            <li>Cara mengatur dan menjaga kestabilan pH air dan kepekatan (PPM) nutrisi.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div
                class="accordion-item bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm transition-all duration-300 hover:shadow-md hover:border-emerald-200">
                <button
                    class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none bg-white transition-colors"
                    onclick="toggleAccordion(this)">
                    <div class="flex items-center gap-4">
                        <span
                            class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-extrabold text-sm shrink-0 border border-emerald-100">3</span>
                        <span class="font-bold text-gray-900 text-base md:text-lg">Hama, Penyakit & Pemanenan</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0 ml-4">
                        <i
                            class="fa-solid fa-chevron-down text-gray-500 accordion-icon transition-transform duration-300"></i>
                    </div>
                </button>
                <div class="accordion-content bg-white border-t border-gray-100">
                    <div class="p-6 md:pl-20 text-gray-600 text-sm leading-relaxed">
                        <ul class="list-disc space-y-3 marker:text-emerald-500 pr-4">
                            <li>Identifikasi hama umum (kutu daun, thrips, ulat) dan cara penanganannya secara organik.
                            </li>
                            <li>Teknik panen yang benar agar kesegaran sayur terjaga lebih lama (pasca-panen).</li>
                            <li>Standardisasi pengemasan sayuran premium.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 -mb-20 px-6 relative bg-emerald-900 overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-5xl mx-auto text-center relative z-10 reveal">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-white">Butuh Pelatihan Khusus untuk <span
                class="text-emerald-400">Instansi / Sekolah?</span></h2>
        <p class="text-emerald-100 text-lg mb-10 max-w-2xl mx-auto">
            Kami melayani program CSR, pelatihan kelompok tani, dan ekstrakurikuler sekolah dengan kurikulum yang bisa
            disesuaikan.
        </p>
        <button onclick="contactInstansi()"
            class="px-8 py-4 rounded-full bg-white text-emerald-700 font-bold hover:bg-emerald-50 hover:scale-105 transition-all shadow-xl">
            <i class="fa-brands fa-whatsapp mr-2 text-emerald-500"></i> Hubungi Tim Kami
        </button>
    </div>
</section>



<div id="toastContainer"
    class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[60] flex flex-col gap-2 pointer-events-none"></div>

<script>
    const classesData = @json($trainings);
    classesData.forEach(cls => {
        cls.image = cls.image ? '/storage/' + cls.image : 'https://via.placeholder.com/400';

        if (!cls.type) cls.type = 'offline';
    });

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    };

    const classGrid = document.getElementById('classGrid');

    function renderClasses(type) {
        classGrid.innerHTML = '';

        const filteredClasses = classesData.filter(c =>
            c.type === type && c.status === 'Aktif'
        );

        filteredClasses.forEach((cls, index) => {

            const booked = cls.registrations_count || 0;
            const sisaKuota = cls.quota - booked;
            const safeSisa = Math.max(sisaKuota, 0);
            const progressWidth = (booked / cls.quota) * 100 || 0;

            // warna kuota
            let kuotaColor = 'bg-emerald-500';
            if (safeSisa <= 5) kuotaColor = 'bg-red-500';
            else if (safeSisa <= 10) kuotaColor = 'bg-yellow-500';

            const isFull = safeSisa <= 0;

            const badgeHTML = cls.status === 'Aktif' ?
                `<div class="absolute top-4 right-4 bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">AKTIF</div>` :
                `<div class="absolute top-4 right-4 bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">TIDAK AKTIF</div>`;

            const cardHTML = `
            <a href="/pelatihan/${cls.id}" class="block">

<div class="glass-card rounded-3xl overflow-hidden group flex flex-col h-full bg-white relative"
     style="animation: fadeUp 0.5s ease-out ${index * 100}ms both;">

    <div class="h-52 overflow-hidden relative bg-gray-100 flex items-center justify-center">
        <i class="fa-solid fa-image text-gray-300 text-4xl absolute z-0"></i>

        <div class="absolute inset-0 bg-gray-900/10 group-hover:bg-transparent transition-colors z-10"></div>

        <img src="${cls.image}"
            alt="${cls.title}"
            onerror="this.style.display='none'"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 relative z-20">

        ${badgeHTML}
    </div>

    <div class="p-6 flex flex-col flex-grow">

        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-2">
            ${cls.title}
        </h4>

        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
            ${cls.description ?? ''}
        </p>

        <div class="space-y-3 mb-6 flex-grow">

            <div class="flex items-center gap-3 text-sm text-gray-600">
                <div class="w-6 text-center">
                    <i class="fa-regular fa-calendar text-emerald-500"></i>
                </div>
                ${cls.date ? new Date(cls.date).toLocaleDateString('id-ID') : '-'}
            </div>

            <div class="flex items-center gap-3 text-sm text-gray-600">
                <div class="w-6 text-center">
                    <i class="fa-regular fa-clock text-emerald-500"></i>
                </div>
                ${cls.time ?? '09:00 - Selesai'}
            </div>

            <div class="flex items-center gap-3 text-sm text-gray-600">
                <div class="w-6 text-center">
                    <i class="fa-solid fa-location-dot text-emerald-500"></i>
                </div>
                <span class="line-clamp-1">${cls.location}</span>
            </div>

        </div>

        <!-- KUOTA -->
        <div class="mb-6 bg-gray-50 p-3 rounded-xl border border-gray-100">
            <div class="flex justify-between text-xs font-bold mb-2">
                <span class="text-gray-500">Kuota Tersedia</span>
                <span class="${safeSisa <= 5 ? 'text-red-500' : 'text-emerald-600'}">
                    Sisa ${safeSisa} kursi
                </span>
            </div>

            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full ${kuotaColor} rounded-full transition-all duration-1000"
                     style="width: ${progressWidth}%"></div>
            </div>
        </div>

        <!-- ACTION -->
        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">

            <div>
                <span class="text-sm text-gray-400">
                    ${cls.status}
                </span>
            </div>

            <button
                ${isFull ? 'disabled' : ''}
                onclick="daftarKelas('${cls.title}')"
                class="px-6 py-2.5 rounded-full
                ${isFull
                    ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                    : 'bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white'}
                font-bold text-sm transition-all shadow-sm">
                ${isFull ? 'Penuh' : 'Daftar'}
            </button>

        </div>

    </div>
</div>
</a>
`;
            classGrid.insertAdjacentHTML('beforeend', cardHTML);
        });
    }

    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            tabBtns.forEach(b => {
                b.classList.remove('active', 'bg-emerald-500', 'text-white',
                    'shadow-[0_4px_15px_rgba(16,185,129,0.3)]', 'border-emerald-500');
                b.classList.add('text-gray-500', 'hover:text-gray-900');
            });

            const currentBtn = e.currentTarget;
            currentBtn.classList.remove('text-gray-500', 'hover:text-gray-900');
            currentBtn.classList.add('active', 'bg-emerald-500', 'text-white',
                'shadow-[0_4px_15px_rgba(16,185,129,0.3)]', 'border-emerald-500');

            const target = currentBtn.dataset.target;
            renderClasses(target);
        });
    });

    renderClasses('offline');

    window.toggleAccordion = function(button) {
        const item = button.parentElement;
        const content = button.nextElementSibling;

        document.querySelectorAll('.accordion-item').forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.classList.remove('open');
                otherItem.querySelector('.accordion-content').classList.remove('open');
            }
        });

        item.classList.toggle('open');
        content.classList.toggle('open');
    }

    const toastContainer = document.getElementById('toastContainer');

    window.contactInstansi = function() {
        showToast(`Membuka WhatsApp B2B Admin...`, 'fa-whatsapp');
    }

    function showToast(message, iconClass) {
        const toast = document.createElement('div');
        toast.className =
            'toast bg-gray-900 text-white px-6 py-4 rounded-full shadow-2xl flex items-center gap-3 text-sm border border-gray-700 pointer-events-auto';
        toast.innerHTML = `
                <div class="w-6 h-6 rounded-full flex items-center justify-center text-emerald-400 text-base">
                    <i class="fa-solid ${iconClass}"></i>
                </div>
                <span>${message}</span>
            `;
        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('hiding');
            toast.addEventListener('animationend', () => toast.remove());
        }, 3000);
    }

    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('bg-white/95', 'shadow-md');
            navbar.classList.remove('border-transparent');
        } else {
            navbar.classList.remove('bg-white/95', 'shadow-md');
        }
    });

    const revealElements = document.querySelectorAll('.reveal');
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

    revealElements.forEach(el => revealOnScroll.observe(el));
</script>

@include('layouts.onboarding.footer')
