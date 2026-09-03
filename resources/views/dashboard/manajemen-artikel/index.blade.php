@include('layouts.dashboard.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Artikel</h1>
        </div>

        <div class="section-body">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="section-title">Manajemen Artikel</h2>
                    <p class="section-lead">
                        Kamu dapat mengelola data artikel di halaman ini.
                    </p>
                </div>
                <a href="{{ route('artikel.create') }}" class="btn btn-primary">+ Tambah
                    Data</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama/Owner</th>
                                            <th>Judul</th>
                                            <th>Konten</th>
                                            <th>Gambar</th>
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $article)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>{{ $article->author->name }}</td>

                                                <td>{{ Str::limit($article->title, 50) }}</td>

                                                <td>{{ Str::limit($article->content, 100) }}</td>


                                                <td>
                                                    <img src="{{ asset('storage/' . $article->image) }}" width="60"
                                                        class="img-thumbnail">
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('manajemen-artikel.show', $article->id) }}"
                                                        class="btn btn-info btn-sm">Detail</a>
                                                </td>

                                                <td class="text-center">
                                                    <form action="{{ route('artikel.destroy', $article->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus artikel ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock') }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@foreach ($data as $product)
    <div class="modal fade" id="modalEdit-{{ $product->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $product->name) }}">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" name="price" class="form-control"
                                value="{{ old('price', $product->price) }}">
                        </div>

                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control"
                                value="{{ old('stock', $product->stock) }}">
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control">

                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="80" class="mt-2">
                            @endif
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endforeach
@include('layouts.dashboard.footer')
