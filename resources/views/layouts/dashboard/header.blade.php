<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Hidroponik GM 200 Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets-stisla/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-stisla/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets-stisla/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-stisla/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-stisla/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-stisla/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    {{-- <script src='https://www.noupe.com/embed/019cf57d08947f689e19cc2df0964a947516.js'></script> --}}
    @auth
        @if (auth()->user()->role === 'admin')
            <script>
                (function() {
                    if (!window.chatbase || window.chatbase("getState") !== "initialized") {
                        window.chatbase = (...arguments) => {
                            if (!window.chatbase.q) {
                                window.chatbase.q = []
                            }
                            window.chatbase.q.push(arguments)
                        };
                        window.chatbase = new Proxy(window.chatbase, {
                            get(target, prop) {
                                if (prop === "q") {
                                    return target.q
                                }
                                return (...args) => target(prop, ...args)
                            }
                        })
                    }
                    const onLoad = function() {
                        const script = document.createElement("script");
                        script.src = "https://www.chatbase.co/embed.min.js";
                        script.id = "dIu-hsL3wRdb7nj7mzijG";
                        script.domain = "www.chatbase.co";
                        document.body.appendChild(script)
                    };
                    if (document.readyState === "complete") {
                        onLoad()
                    } else {
                        window.addEventListener("load", onLoad)
                    }
                })
                ();
            </script>
        @endif
    @endauth

    {{-- Modul Datatable --}}
    <link rel="stylesheet" href="{{ asset('assets-stisla/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets-stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-stisla/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>

                </form>
                <ul class="navbar-nav navbar-right">
                    @php
                        use Illuminate\Support\Facades\DB;

                        $notifTraining = DB::table('training_registrations')
                            ->join('trainings', 'training_registrations.training_id', '=', 'trainings.id')
                            ->select(
                                DB::raw("'training' as type"),
                                'trainings.title as title',
                                'training_registrations.name as name',
                                DB::raw('NULL as phone'),
                                DB::raw('NULL as total_item'),
                                'training_registrations.created_at',
                            )
                            ->get();

                        $notifOrder = DB::table('orders')
                            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                            ->select(
                                DB::raw("'order' as type"),
                                DB::raw('NULL as title'),
                                'orders.name',
                                'orders.phone',
                                DB::raw('SUM(order_items.quantity) as total_item'),
                                'orders.created_at',
                            )
                            ->groupBy('orders.id', 'orders.name', 'orders.phone', 'orders.created_at')
                            ->get();

                        $notifications = $notifTraining->merge($notifOrder)->sortByDesc('created_at');
                    @endphp
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifikasi

                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                @foreach ($notifications as $item)
                                    @if ($item->type == 'order')
                                        <a href="{{ auth()->user()->role == 'admin' ? '/manajemen-pemesanan' : '#' }}"
                                            class="dropdown-item">
                                            <div class="dropdown-item-icon bg-primary text-white">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="dropdown-item-desc">
                                                <b>{{ $item->name }}</b> ({{ $item->phone }}) pesan
                                                <b>{{ $item->total_item }} item</b>
                                                <div class="time">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </a>
                                    @endif

                                    @if ($item->type == 'training')
                                        <a href="/manajemen-pelatihan" class="dropdown-item dropdown-item-unread">
                                            <div class="dropdown-item-icon bg-success text-white">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                            </div>
                                            <div class="dropdown-item-desc">
                                                <b>{{ $item->name }}</b> daftar ke <b>{{ $item->title }}</b>
                                                <div class="time text-primary">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle flex items-center nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets-stisla/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/dashboard">GM 200</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/dashboard">GM</a>
                    </div>
                    <ul class="sidebar-menu">

                        <li>
                            <a class="nav-link {{ request()->is('dashboard') ? 'text-success' : '' }}"
                                href="/dashboard">
                                <i class="fas fa-home"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- ================= OWNER ================= -->
                        @if (auth()->user()->role === 'owner')
                            <li class="menu-header">Owner Menu</li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-admin', 'manajemen-admin/*') ? 'text-success' : '' }}"
                                    href="/manajemen-admin">
                                    <i class="fas fa-user-cog"></i> <span>Manajemen Admin</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('data-produk', 'data-produk/*') ? 'text-success' : '' }}"
                                    href="/data-produk">
                                    <i class="fas fa-box"></i> <span>Data Produk</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-artikel', 'manajemen-artikel/*') ? 'text-success' : '' }}"
                                    href="/manajemen-artikel">
                                    <i class="fas fa-newspaper"></i> <span>Manajemen Artikel</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-pelatihan', 'manajemen-pelatihan/*') ? 'text-success' : '' }}"
                                    href="/manajemen-pelatihan">
                                    <i class="fas fa-chalkboard-teacher"></i> <span>Manajemen Pelatihan</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-review', 'manajemen-review/*') ? 'text-success' : '' }}"
                                    href="/manajemen-review">
                                    <i class="fas fa-star"></i> <span>Manajemen Review</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-medsos', 'manajemen-medsos/*') ? 'text-success' : '' }}"
                                    href="/manajemen-medsos">
                                    <i class="fas fa-share-alt"></i> <span>Manajemen Medsos</span>
                                </a>
                            </li>
                        @endif


                        <!-- ================= ADMIN ================= -->
                        @if (auth()->user()->role === 'admin')
                            <li class="menu-header">Admin Menu</li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-produksi', 'manajemen-produksi/*') ? 'text-success' : '' }}"
                                    href="/manajemen-produksi">
                                    <i class="fas fa-industry"></i> <span>Manajemen Produksi</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link {{ request()->is('manajemen-pemesanan', 'manajemen-pemesanan/*') ? 'text-success' : '' }}"
                                    href="/manajemen-pemesanan">
                                    <i class="fas fa-money-bill"></i> <span>Manajemen Pemesanan</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('data-produk', 'data-produk/*') ? 'text-success' : '' }}"
                                    href="/data-produk">
                                    <i class="fas fa-box"></i> <span>Data Produk</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-artikel', 'manajemen-artikel/*') ? 'text-success' : '' }}"
                                    href="/manajemen-artikel">
                                    <i class="fas fa-newspaper"></i> <span>Manajemen Artikel</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-pelatihan', 'manajemen-pelatihan/*') ? 'text-success' : '' }}"
                                    href="/manajemen-pelatihan">
                                    <i class="fas fa-chalkboard-teacher"></i> <span>Manajemen Pelatihan</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link {{ request()->is('manajemen-review', 'manajemen-review/*') ? 'text-success' : '' }}"
                                    href="/manajemen-review">
                                    <i class="fas fa-star"></i> <span>Manajemen Review</span>
                                </a>
                            </li>
                        @endif

                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit"
                                onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }"
                                class="btn btn-danger btn-lg btn-block btn-icon-split">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
