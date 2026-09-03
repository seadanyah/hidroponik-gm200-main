@include('layouts.dashboard.header')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Admin</h1>
        </div>

        <div class="section-body">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="section-title">Manajemen Admin</h2>
                    <p class="section-lead">
                        Kamu dapat mengelola data admin di halaman ini.
                    </p>
                </div>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">+ Tambah
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
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $admin)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->phone }}</td>
                                                <td>{{ $admin->address }}</td>

                                                <td>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modal-edit-{{ $admin->id }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('admin.destroy', $admin->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus admin ini?')">
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

{{-- Modal Tambah --}}
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('admin.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Admin</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" required name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Masukkan nama">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" required name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Masukkan email">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" required name="password" class="form-control"
                            placeholder="Masukkan password">
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    </div>

                    <div class="form-group">
                        <label>Nomor HP</label>
                        <input type="number" required name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="Masukkan nomor telepon">
                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" required class="form-control" placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                    </div>

                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Modal Edit --}}
@foreach ($data as $admin)
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-{{ $admin->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Admin</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $admin->name) }}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $admin->email) }}">
                        </div>

                        <div class="form-group">
                            <label>Password (Opsional)</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak diubah">
                        </div>

                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $admin->phone) }}">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control">{{ old('address', $admin->address) }}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endforeach
@if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
@endif
@include('layouts.dashboard.footer')
