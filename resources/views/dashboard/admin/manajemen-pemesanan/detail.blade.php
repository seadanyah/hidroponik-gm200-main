@include('layouts.dashboard.header')

<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Detail Pesanan #{{ $order->id }}</h1>
        </div>

        <div class="section-body">
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
            <a href="/manajemen-pemesanan" class="flex items-center text-xl gap-1 mb-4">
                ← Kembali
            </a>
            <div class="card">
                <div class="card-body">

                    <h5 class="mt-3">Ubah Status</h5>

                    <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="dibayar" {{ $order->status == 'dibayar' ? 'selected' : '' }}>Dibayar
                                </option>
                                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim
                                </option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-success">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">

                <!-- DATA PEMESAN -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pemesan</h4>
                        </div>
                        <div class="card-body">

                            <p><b>Nama:</b><br>{{ $order->name }}</p>

                            <p><b>No HP:</b><br>{{ $order->phone }}</p>

                            <p><b>Email:</b><br>{{ $order->email }}</p>

                            <p><b>Alamat:</b><br>{{ $order->address }}</p>

                            <p><b>Catatan:</b><br>{{ $order->note ?? '-' }}</p>

                            <p><b>Status:</b><br>
                                <span
                                    class="badge
    {{ $order->status == 'pending' ? 'badge-warning' : '' }}
    {{ $order->status == 'dibayar' ? 'badge-info' : '' }}
    {{ $order->status == 'dikirim' ? 'badge-primary' : '' }}
    {{ $order->status == 'selesai' ? 'badge-success' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>

                            <p><b>Tanggal Order:</b><br>
                                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y H:i') }}
                            </p>
                            <div class="mt-4 d-flex flex-column gap-2">

                                <!-- BUTTON STRUK -->
                                <a href="{{ route('manajemen-pemesanan.invoice', $order->id) }}" target="_blank"
                                    class="btn btn-dark btn-primary d-flex align-items-center justify-content-center gap-2">

                                    <i class="fas fa-receipt"></i>
                                    <span>Lihat Struk</span>
                                </a>

                                <!-- BUTTON WHATSAPP -->
                                @php
                                    $phone = preg_replace('/^0/', '62', $order->phone);
                                    $message = urlencode(
                                        "Halo {$order->name}, pesanan Anda dengan ID #{$order->id} sedang diproses. Terima kasih 🙏",
                                    );
                                @endphp

                                <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                                    class="btn btn-success btn-block d-flex align-items-center justify-content-center gap-2">

                                    <i class="fab fa-whatsapp"></i>
                                    <span>Hubungi via WhatsApp</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- DATA PRODUK -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Produk</h4>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->product->name }} </td>
                                                <td>
                                                    Rp {{ number_format($item->price) }}
                                                </td>

                                                <td>
                                                    {{ $item->quantity }}
                                                </td>

                                                <td>
                                                    Rp {{ number_format($item->price * $item->quantity) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- TOTAL -->
                            <div class="text-right mt-4">
                                <h4>
                                    Total Harga:
                                    <span class="text-success">
                                        Rp {{ number_format($order->total_price) }}
                                    </span>
                                </h4>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</div>

@include('layouts.dashboard.footer')
