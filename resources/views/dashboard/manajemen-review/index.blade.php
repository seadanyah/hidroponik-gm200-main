@include('layouts.dashboard.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Review</h1>
        </div>

        <div class="section-body">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="section-title">Manajemen Review</h2>
                    <p class="section-lead">
                        Kamu dapat mengelola data review di halaman ini.
                    </p>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Id Order</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Phone</th>
                                            <th>Review</th>
                                            <th>Rating</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>#{{ $item->order_id }}</td>

                                                <td>{{ $item->created_at->format('d M Y') }}</td>

                                                <td>{{ $item->name }}</td>

                                                <td>{{ $item->phone }}</td>

                                                <td>{{ Str::limit($item->review, 50) }}</td>

                                                <td>
                                                    ⭐ {{ $item->rating }}
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge {{ $item->tampil == 'ya' ? 'badge-success' : 'badge-secondary' }}">
                                                        {{ $item->tampil }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <form
                                                        action="{{ route('manajemen-review.updateStatus', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <select name="tampil"
                                                            class="form-control form-control-sm mb-2">
                                                            <option value="ya"
                                                                {{ $item->tampil == 'ya' ? 'selected' : '' }}>Tampilkan
                                                            </option>
                                                            <option value="tidak"
                                                                {{ $item->tampil == 'tidak' ? 'selected' : '' }}>
                                                                Sembunyikan</option>
                                                        </select>
                                                        <button class="btn btn-primary btn-sm">
                                                            Update
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

@include('layouts.dashboard.footer')
