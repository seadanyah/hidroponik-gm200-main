@include('layouts.dashboard.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Produk</h1>
        </div>

        <div class="section-body">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="section-title">Manajemen Produk</h2>
                    <p class="section-lead">
                        Kamu dapat mengelola data produk di halaman ini.
                    </p>
                </div>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">+ Tambah
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
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Min. Order</th>
                                            <th>Jenis</th>
                                            <th>Gambar</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $product)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>{{ $product->name }}</td>

                                                <td>{{ Str::limit($product->description, 50) }}</td>

                                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->min_order }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>
                                                    @if ($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            width="60" class="img-thumbnail">
                                                    @else
                                                        <span class="text-muted">Tidak ada</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#modalEdit-{{ $product->id }}">
                                                        Edit
                                                    </button>
                                                </td>

                                                <td class="text-center">
                                                    <form action="{{ route('product.destroy', $product->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus produk ini?')">
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
                        <input required type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea required name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input required type="number" name="price"
                            class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input required type="number" name="stock"
                            class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Min. Order</label>
                        <input required type="number" name="min_order"
                            class="form-control @error('min_order') is-invalid @enderror"
                            value="{{ old('min_order') }}">
                        @error('min_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select required name="unit" id="unit"
                            class="form-control @error('unit') is-invalid @enderror ">
                            <option value="ikat">ikat</option>
                            <option value="kg">kg</option>
                            <option value="gram">gram</option>
                            <option value="pack">pack</option>
                            <option value="buah">buah</option>
                            <option value="ons">ons</option>
                        </select>
                        </select>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input required type="file" name="image"
                            class="form-control @error('image') is-invalid @enderror">
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
                            <input required type="text" name="name" class="form-control"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea required name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <input required type="number" name="price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price', $product->price) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Stok</label>
                            <input required type="number" name="stock"
                                class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Min. Order</label>
                            <input required type="number" name="min_order"
                                class="form-control @error('min_order') is-invalid @enderror"
                                value="{{ old('min_order', $product->min_order) }}">
                            @error('min_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis</label>
                            <select required name="unit" id="unit" class="form-control">
                                <option value="ikat" {{ $product->unit == 'ikat' ? 'selected' : '' }}>ikat
                                </option>
                                <option value="kg" {{ $product->unit == 'kg' ? 'selected' : '' }}>kg</option>
                                <option value="gram" {{ $product->unit == 'gram' ? 'selected' : '' }}>gram
                                </option>
                                <option value="pack" {{ $product->unit == 'pack' ? 'selected' : '' }}>pack
                                </option>
                                <option value="buah" {{ $product->unit == 'buah' ? 'selected' : '' }}>buah
                                </option>
                                <option value="ons" {{ $product->unit == 'ons' ? 'selected' : '' }}>ons</option>
                            </select>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control">

                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="80" class="mt-2">
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
