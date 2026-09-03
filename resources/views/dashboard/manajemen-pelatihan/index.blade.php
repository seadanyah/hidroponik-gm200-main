@include('layouts.dashboard.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Pelatihan</h1>
        </div>

        <div class="section-body">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="section-title">Manajemen Pelatihan</h2>
                    <p class="section-lead">
                        Kamu dapat mengelola data pelatihan di halaman ini.
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
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Lokasi</th>
                                            <th>Kuota</th>
                                            <th>Pendaftar</th>
                                            <th>Gambar</th>
                                            <th>Detail</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $training)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($training->status == 'Aktif')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td>{{ $training->title }}</td>
                                                <td>{{ Str::limit($training->description, 50) }}</td>
                                                <td>{{ $training->date }}</td>
                                                <td>{{ \Carbon\Carbon::parse($training->time)->format('H.i') }} WIB</td>
                                                <td>{{ $training->location }}</td>
                                                <td>{{ $training->quota }}</td>
                                                <td>{{ $training->registrations_count }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $training->image) }}"
                                                        width="60">
                                                </td>
                                                <td>
                                                    <a href="{{ route('manajemen-pelatihan.show', $training->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        Detail
                                                    </a>
                                                </td>


                                                <td>
                                                    <form action="{{ route('pelatihan.destroy', $training->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus data?')">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('pelatihan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelatihan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" required name="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea name="description" required class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" name="date" required
                                class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input type="time" name="time" required
                                class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lokasi</label>
                        <div class="col-sm-9">
                            <input type="text" required name="location" class="form-control"
                                value="{{ old('location') }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kuota</label>
                        <div class="col-sm-9">
                            <input type="number" required name="quota" class="form-control"
                                value="{{ old('quota') }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" required name="image"
                                class="form-control @error('image') is-invalid @enderror">
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@foreach ($data as $training)
    <div class="modal fade" id="modalEdit-{{ $training->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('pelatihan.update', $training->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pelatihan</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $training->title) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control">{{ old('description', $training->description) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="date" class="form-control"
                                    value="{{ old('date', $training->date) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Waktu</label>
                            <div class="col-sm-9">
                                <input type="time" name="time" class="form-control"
                                    value="{{ old('time', $training->time) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" name="location" class="form-control"
                                    value="{{ old('location', $training->location) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kuota</label>
                            <div class="col-sm-9">
                                <input type="number" name="quota" class="form-control"
                                    value="{{ old('quota', $training->quota) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control">

                                @if ($training->image)
                                    <img src="{{ asset('storage/' . $training->image) }}" class="img-thumbnail mt-2"
                                        width="100">
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endforeach
@include('layouts.dashboard.footer')
