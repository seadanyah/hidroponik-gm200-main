@include('layouts.dashboard.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pendaftar Pelatihan</h1>
        </div>

        <div class="section-body">
            <div class="flex justify-between items-center">
                <a href="/manajemen-pelatihan" class="flex mb-2 items-center text-xl gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                    Kembali
                </a>
                <a href="#" class="btn btn-warning flex gap-2 items-center" data-toggle="modal"
                    data-target="#ubahStatusModal"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    Ubah Status</a>
            </div>

            <div class="flex items-center justify-between mb-3">
                <a href="#" class="btn btn-primary flex gap-2 items-center" data-toggle="modal"
                    data-target="#editModal"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    Edit Data</a>
            </div>
            @if ($data->status == 'Aktif')
                <div class="bg-success text-white p-3 mb-3 rounded">
                    Status: {{ $data->status }}
                </div>
            @else
                <div class="bg-danger text-white p-3 mb-3 rounded">
                    Status: {{ $data->status }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image"
                                style="background-image: url('{{ asset('storage/' . $data->image) }}'); height: 300px; background-size: cover;">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-title">
                                <h2>{{ $data->title }}</h2>
                            </div>
                            <p>{{ $data->description }}</p>
                            <ul class="list-unstyled mt-3">
                                <li><strong>📅 Tanggal:</strong> {{ $data->date }}</li>
                                <li><strong>📍 Lokasi:</strong> {{ $data->location }}</li>
                                <li><strong>👥 Kuota:</strong> {{ $data->quota }} orang</li>
                                <li><strong>⏰ Waktu:</strong> {{ \Carbon\Carbon::parse($data->time)->format('H.i') }}
                                    WIB</li>
                            </ul>
                        </div>
                    </article>
                </div>
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
                    <h1>Pendaftar</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Pekerjaan</th>
                                            <th>Institusi</th>
                                            <th>WhatsApp</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($registrations as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->pekerjaan }}</td>
                                                <td>{{ $item->institusi ?? '-' }}</td>
                                                <td>
                                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $item->phone) }}"
                                                        target="_blank" class="btn btn-success btn-sm">
                                                        Chat
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('pendaftar.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus pendaftar ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    Belum ada pendaftar
                                                </td>
                                            </tr>
                                        @endforelse
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


{{-- Ubah Status --}}
<div class="modal fade" id="ubahStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('pelatihan.updateStatus', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Pelatihan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">



                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Tidak Aktif" {{ $data->status == 'Tidak Aktif' ? 'selected' : '' }}>
                                    Tidak Aktif
                                </option>

                            </select>
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


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('pelatihan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                            <input required type="text" name="title" class="form-control"
                                value="{{ old('title', $data->title) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea required name="description" class="form-control">{{ old('description', $data->description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input required type="date" name="date" class="form-control"
                                value="{{ old('date', $data->date) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input required type="time" name="time" class="form-control"
                                value="{{ old('time', $data->time) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lokasi</label>
                        <div class="col-sm-9">
                            <input required type="text" name="location" class="form-control"
                                value="{{ old('location', $data->location) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kuota</label>
                        <div class="col-sm-9">
                            <input required type="number" name="quota" class="form-control"
                                value="{{ old('quota', $data->quota) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" name="image" class="form-control">

                            @if ($data->image)
                                <img src="{{ asset('storage/' . $data->image) }}" class="img-thumbnail mt-2"
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


@include('layouts.dashboard.footer')
