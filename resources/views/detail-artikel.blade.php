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

    /* Reading Progress Bar */
    #progressBar {
        transform-origin: left;
        transform: scaleX(0);
        transition: transform 0.1s ease;
    }

    /* Typography Styling for Article Body */
    .article-body h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #111827;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }

    .article-body h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1F2937;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
    }

    .article-body p {
        margin-bottom: 1.25rem;
        line-height: 1.8;
        color: #4B5563;
    }

    .article-body ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.25rem;
        color: #4B5563;
        line-height: 1.8;
    }

    .article-body li {
        margin-bottom: 0.5rem;
    }

    .article-body blockquote {
        border-left: 4px solid #10B981;
        padding-left: 1.5rem;
        font-style: italic;
        color: #374151;
        background: #ecfdf5;
        padding: 1.5rem;
        border-radius: 0 1rem 1rem 0;
        margin: 2rem 0;
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
        opacity: 0.4;
    }
</style>
<div class="fixed top-0 left-0 w-full h-1.5 bg-gray-200 z-[60]">
    <div id="progressBar" class="h-full bg-emerald-500 w-full"></div>
</div>
<main class="pt-32 pb-24 px-6 relative min-h-screen">

    <!-- Ambient Light Glows -->
    <div class="glow-blob bg-emerald-100 w-[500px] h-[500px] top-0 right-0"></div>
    <div class="glow-blob bg-teal-50 w-[600px] h-[600px] top-[40%] left-[-10%]"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8 font-medium">
            <a href="/artikel" class="hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Blog
            </a>
            <span class="text-gray-300">|</span>

            <span class="text-gray-900 font-bold truncate hidden sm:inline">{{ $artikel->title }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <!-- Kolom Kiri: Konten Utama Artikel -->
            <div class="lg:col-span-12">

                <!-- Header Artikel -->
                <header class="mb-10">


                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-[1.2]">
                        {{ $artikel->title }}
                    </h1>



                </header>

                <!-- Gambar Utama Artikel -->
                <div class="mb-12 rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                    <img src="{{ asset('storage/' . $artikel->image) }}" alt="Nutrisi Hidroponik"
                        class="w-full h-auto max-h-[500px] object-cover">

                </div>

                <!-- Isi Artikel (Body) -->
                <div class="article-body text-lg">
                    {!! $artikel->content !!}
                </div>

                <!-- Tags & Bottom Share -->
                <div
                    class="mt-12 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">


                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-900">Bagikan:</span>
                        <button onclick="copyLink()"
                            class="w-10 h-10 rounded-full bg-emerald-900 text-white hover:bg-emerald-500 flex items-center justify-center transition-colors">
                            <i class="fa-solid fa-link text-sm"></i>
                        </button>

                    </div>
                </div>


            </div>


        </div>
    </div>
</main>

<!-- Toast Container -->
<div id="toastContainer"
    class="fixed bottom-10 left-1/2 transform -translate-x-1/2 z-[100] flex flex-col gap-2 pointer-events-none"></div>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ========================
        // ELEMENT
        // ========================
        const navbar = document.getElementById('navbar');
        const progressBar = document.getElementById('progressBar');

        // ========================
        // SCROLL EFFECT
        // ========================
        window.addEventListener('scroll', () => {

            if (navbar) {
                if (window.scrollY > 20) {
                    navbar.classList.add('bg-white/95', 'shadow-md');
                    navbar.classList.remove('border-transparent');
                } else {
                    navbar.classList.remove('bg-white/95', 'shadow-md');
                }
            }

            if (progressBar) {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement
                    .clientHeight;
                const scrolled = (winScroll / height);
                progressBar.style.transform = `scaleX(${scrolled})`;
            }
        });

        // ========================
        // BOOKMARK (GLOBAL)
        // ========================
        let isBookmarked = false;

        window.toggleBookmark = function(btnElement) {
            isBookmarked = !isBookmarked;

            const icon = btnElement.querySelector('i');

            if (!icon) return;

            if (isBookmarked) {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                btnElement.classList.add('text-emerald-500');
                btnElement.classList.remove('text-gray-400');
                showToast('Artikel disimpan!', 'fa-bookmark', 'bg-emerald-500');
            } else {
                icon.classList.add('fa-regular');
                icon.classList.remove('fa-solid');
                btnElement.classList.remove('text-emerald-500');
                btnElement.classList.add('text-gray-400');
                showToast('Dihapus dari koleksi', 'fa-bookmark', 'bg-gray-500');
            }
        }

        // ========================
        // COPY LINK (GLOBAL)
        // ========================
        window.copyLink = function() {
            const currentUrl = window.location.href;

            navigator.clipboard.writeText(currentUrl).then(() => {
                showToast('Link disalin!', 'fa-link', 'bg-emerald-500');
            }).catch(() => {
                showToast('Gagal menyalin', 'fa-circle-xmark', 'bg-red-500');
            });
        }

        // ========================
        // TOAST
        // ========================
        function showToast(message, iconClass, bgColorClass) {
            const toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) return;

            const toast = document.createElement('div');

            toast.className =
                'toast bg-gray-900 text-white px-6 py-3 rounded-full shadow flex items-center gap-3';

            toast.innerHTML = `
            <div class="w-6 h-6 rounded-full ${bgColorClass} flex items-center justify-center">
                <i class="fa-solid ${iconClass} text-xs"></i>
            </div>
            <span>${message}</span>
        `;

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

    });
</script>
@include('layouts.onboarding.footer')
