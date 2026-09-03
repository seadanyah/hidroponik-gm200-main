@include('layouts.onboarding.header')
<section class="pt-32 pb-12 px-6 bg-gradient-to-b from-emerald-50 to-white relative">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-gray-900">Pojok <span
                    class="text-gradient">Edukasi</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Pelajari tips bertani, wawasan bisnis hidroponik, dan
                panduan lengkap dari para pakar GM 200.</p>
        </div>
        <a href="/artikel/{{ \Illuminate\Support\Str::slug($latest->title) }}">
            <div class="relative rounded-[2rem] overflow-hidden shadow-xl group cursor-pointer border border-gray-100">
                <div
                    class="absolute inset-0 bg-gray-900/40 group-hover:bg-gray-900/20 transition-colors duration-500 z-10">
                </div>
                <img src="{{ asset('storage/' . $latest->image) }}" alt="Featured Article"
                    class="w-full h-[400px] md:h-[500px] object-cover img-zoom">

                <div
                    class="absolute bottom-0 left-0 w-full p-8 md:p-12 z-20 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full">TERBARU</span>
                    </div>
                    <h2
                        class="text-3xl md:text-5xl font-bold text-white mb-4 group-hover:text-emerald-400 transition-colors leading-tight">
                        {{ $latest->title }}</h2>
                    <p class="text-gray-300 md:text-lg mb-6 line-clamp-2 max-w-3xl">
                        {{ Str::limit(strip_tags($latest->content), 150) }} </p>
                    <div class="flex items-center justify-between">

                        <button
                            class="w-12 h-12 rounded-full bg-white/20 hover:bg-emerald-500 text-white flex items-center justify-center transition-all backdrop-blur-sm">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </a>
    </div>
</section>

<section class="pb-24 px-6 bg-white min-h-[50vh]">
    <div class="max-w-7xl mx-auto">

        <div
            class="flex flex-col md:flex-row justify-between items-center gap-6 mb-12 sticky top-20 bg-white/90 backdrop-blur-md py-4 z-30 border-b border-gray-100">


            <div class="relative w-full">
                <input type="text" id="searchInput" placeholder="Cari artikel..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-full border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-700 bg-gray-50 text-sm">
                <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
            </div>
        </div>

        <div id="articleGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        </div>

        <div id="emptyState" class="hidden text-center py-20">
            <i class="fa-solid fa-folder-open text-6xl text-gray-200 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Artikel tidak ditemukan</h3>
            <p class="text-gray-500">Coba gunakan kata kunci pencarian yang lain.</p>
            <button onclick="resetFilters()"
                class="mt-4 px-6 py-2 bg-emerald-50 text-emerald-600 font-bold rounded-lg hover:bg-emerald-100 transition-colors">Reset
                Pencarian</button>
        </div>


    </div>
</section>




<div id="toastContainer"
    class="fixed bottom-10 left-1/2 transform -translate-x-1/2 z-50 flex flex-col gap-2 pointer-events-none"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const articleGrid = document.getElementById('articleGrid');
        if (!articleGrid) return;


        const articlesData = @json($data);

        articlesData.forEach(article => {
            article.excerpt = article.content ? article.content.substring(0, 100) : '';
            article.categoryLabel = 'ARTIKEL';
            article.readTime = '5 Menit';
            article.date = article.created_at ?
                new Date(article.created_at).toLocaleDateString('id-ID') :
                '';
            article.bookmarked = false;

            article.image = article.image ?
                '/storage/' + article.image :
                'https://via.placeholder.com/600x400';
        });

        const emptyState = document.getElementById('emptyState');
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        const searchInput = document.getElementById('searchInput');

        function renderArticles(articles) {
            articleGrid.innerHTML = '';

            if (!articles.length) {
                articleGrid.classList.add('hidden');
                if (emptyState) emptyState.classList.remove('hidden');
                if (loadMoreContainer) loadMoreContainer.classList.add('hidden');
                return;
            }

            articleGrid.classList.remove('hidden');
            if (emptyState) emptyState.classList.add('hidden');
            if (loadMoreContainer) loadMoreContainer.classList.remove('hidden');

            articles.forEach((article, index) => {
                const bookmarkIcon = article.bookmarked ?
                    'fa-solid text-emerald-500' :
                    'fa-regular text-gray-400 hover:text-emerald-500';

                const cardHTML = `
                <div class="glass-card rounded-3xl overflow-hidden group flex flex-col h-full bg-white relative"
                     style="animation: slideInUp 0.5s ease-out ${index * 50}ms both;">


                    <div class="h-56 overflow-hidden relative">
                        <img src="${article.image}" alt="${article.title}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-3 text-xs font-bold">
                            <span class="text-emerald-500 bg-emerald-50 px-2 py-1 rounded">${article.categoryLabel}</span>

                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            ${article.title}
                        </h3>

                        <p class="text-sm text-gray-500 mb-6 flex-grow">
                            ${article.excerpt}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-4 border-t">
                            <span class="text-xs text-gray-400">${article.date}</span>
                            <a href="/artikel/${article.slug}"
                                class="text-sm font-bold text-emerald-500">
                                Baca →
                            </a>
                        </div>
                    </div>
                </div>
            `;

                articleGrid.insertAdjacentHTML('beforeend', cardHTML);
            });
        }


        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();

            const filtered = articlesData.filter(article =>
                article.title.toLowerCase().includes(searchTerm) ||
                article.excerpt.toLowerCase().includes(searchTerm)
            );

            renderArticles(filtered);
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }


        window.resetFilters = function() {
            if (searchInput) searchInput.value = '';
            renderArticles(articlesData);
        }


        renderArticles(articlesData);

    });
</script>
@include('layouts.onboarding.footer')
