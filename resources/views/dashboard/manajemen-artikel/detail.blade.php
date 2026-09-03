@include('layouts.dashboard.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Artikel</h1>
        </div>

        <div class="section-body">
            <a href="/manajemen-artikel" class="flex items-center text-xl gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
                Kembali
            </a>
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="section-title">Detail Artikel</h2>
                </div>
                <a href="{{ route('artikel.edit', $data->id) }}" class="btn btn-primary flex items-center gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>Edit
                    Data</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ asset('storage/' . $data->image) }}">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-title">
                                <h2>{{ $data->title }}</a>
                            </div>
                            <p>{!! $data->content !!}</p>
                        </div>
                    </article>
                </div>

            </div>

        </div>
    </section>
</div>


@include('layouts.dashboard.footer')
