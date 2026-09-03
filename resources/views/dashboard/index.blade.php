@include('layouts.dashboard.header')

<div class="main-content">
    <section class="section">

        <!-- SAPAAN -->
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">
                Hi, {{ auth()->user()->name ?? 'Owner GM200' }} 👋
            </h2>
            <p class="section-lead">
                Berikut adalah laporan penjualan produk hidroponik kamu.
            </p>

            <!-- CARD RINGKASAN -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Order</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalOrder }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon text-white font-bold text-xl bg-success">
                            Rp
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pendapatan</h4>
                            </div>
                            <div class="card-body">
                                Rp {{ number_format($totalRevenue) }} </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Produk Terjual</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSold }} </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRAFIK -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Laporan Penjualan Bulanan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Penjualan',
                data: @json($sales),
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
@include('layouts.dashboard.footer')
