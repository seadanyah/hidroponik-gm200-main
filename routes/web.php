<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdmminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ArtikelCustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderCustomerController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukCustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingCustomerController;
use App\Models\Article;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Training;
use App\Models\TrainingRegistration;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    $data = Product::latest()->take(4)->get();
    $pelatihan = Training::latest()->where('status', 'Aktif')->take(2)->get();
    $artikel = Article::latest()->take(3)->get();

    $review = Review::where('tampil', 'ya')
        ->latest()
        ->take(3)
        ->get();
    return view('welcome', compact('data', 'pelatihan', 'artikel', 'review'));
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// web onboarding
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/produk', function () {
    $data = Product::latest()->get();

    return view('produk', compact('data'));
})->name('produk');

Route::get('/artikel', function () {
    $latest = Article::orderBy('id', 'desc')->first();

    if ($latest) {
        $latest->slug = Str::slug($latest->title);
    }

    // Perbaikan ada di baris bawah ini (pakai optional)
    $data = Article::where('id', '!=', optional($latest)->id)
        ->orderBy('id', 'desc')
        ->get()
        ->map(function ($item) {
            $item->slug = Str::slug($item->title);
            return $item;
        });

    return view('artikel', compact('latest', 'data'));
});

Route::get('/artikel/{slug}', [ArtikelCustomerController::class, 'show'])->name('artikel.show');

Route::get('/pelatihan', function () {
    $trainings = Training::withCount('registrations')
        ->where('status', 'Aktif')
        ->orderBy('id', 'desc')
        ->get();

    return view('pelatihan', compact('trainings'));
})->name('pelatihan');

Route::get('/pelatihan/{id}', [TrainingCustomerController::class, 'show'])->name('pelatihan.show');

Route::get('/produk/{id}', [ProdukCustomerController::class, 'show'])->name('produk.show');

// Checkout
Route::get('/checkout', [OrderCustomerController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [OrderCustomerController::class, 'store']);

Route::post('/pelatihan/daftar/{id}', [TrainingCustomerController::class, 'store'])->name('pelatihan.daftar');

// middleware dashboard owner & admin
Route::middleware(['auth', 'role:owner,admin'])->group(function () {
    Route::get('/dashboard', function () {
        $admin = User::where('role', 'admin')->first();

        $totalOrder = Order::count();
        $totalRevenue = Order::where('status', '!=', 'dibatalkan')
            ->sum('total_price');
        $totalSold = OrderItem::sum('quantity');
        $salesData = array_fill(1, 12, 0);

        $orders = Order::select(
            DB::raw('MONTH(order_date) as month'),
            DB::raw('SUM(total_price) as total')
        )
            ->groupBy('month')
            ->get();

        foreach ($orders as $o) {
            $salesData[$o->month] = $o->total;
        }
        $sales = array_values($salesData);

        return view('dashboard.index', compact(
            'totalOrder',
            'totalRevenue',
            'totalSold',
            'sales',
            'admin',
        ));
    })->name('dashboard');

    // Profile
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/manajemen-admin', [AdminController::class, 'index'])->name('manajemen-admin.index');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

    // Manajemen produk
    Route::get('/data-produk', [ProdukController::class, 'index'])->name('manajemen-produk.index');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('product.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('product.destroy');

    // Manajemen Artikel
    Route::get('/manajemen-artikel', [ArtikelController::class, 'index'])->name('manajemen-artikel.index');
    Route::get('/manajemen-artikel/tambah', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::get('/manajemen-artikel/{id}', [ArtikelController::class, 'show'])->name('manajemen-artikel.show');
    Route::post('/artikel/store', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::put('/artikel/update/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::get('/manajemen-artikel/edit/{id}', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::delete('/artikel/delete/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // Manajemen Pelatihan
    Route::get('/manajemen-pelatihan', [TrainingController::class, 'index'])->name('manajemen-pelatihan.index');
    Route::post('/pelatihan/store', [TrainingController::class, 'store'])->name('pelatihan.store');
    Route::put('/pelatihan/update/{id}', [TrainingController::class, 'update'])->name('pelatihan.update');
    Route::delete('/pelatihan/delete/{id}', [TrainingController::class, 'destroy'])->name('pelatihan.destroy');
    Route::get('/manajemen-pelatihan/{id}', [TrainingController::class, 'show'])->name('manajemen-pelatihan.show');

    // Ubah status pelatihan
    Route::put('/pelatihan/update-status/{id}', [TrainingController::class, 'updateStatus'])->name('pelatihan.updateStatus');

    // Pendaftar Pelatihan
    Route::delete('/pendaftar/delete/{id}', [TrainingController::class, 'destroyPendaftar'])->name('pendaftar.destroy');

    // Manajemen Review
    Route::get('/manajemen-review', [ReviewController::class, 'index'])->name('manajemen-review.index');
    Route::put('/review/{id}/status', [ReviewController::class, 'updateStatus'])->name('manajemen-review.updateStatus');

    // Manajemen Sosmed
    Route::get('/manajemen-medsos', [SosmedController::class, 'index'])->name('manajemen-medsos.index');

    Route::post('/generate-ai', [SosmedController::class, 'generate'])->name('manajemen-medsos.generate');
    Route::post('/save-post', [SosmedController::class, 'store'])->name('manajemen-medsos.post');

    Route::post('/update-status-post', [SosmedController::class, 'updateStatus'])->name('manajemen-medsos.update-status');
});

// Middleware dashboard admin (hanya manajemen pemesanan)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Manajemen Produksi
    Route::get('/manajemen-produksi', [ProductionController::class, 'index'])->name('manajemen-produksi.index');
    Route::post('/manajemen-produksi/store', [ProductionController::class, 'store'])->name('manajemen-produksi.store');
    Route::put('/manajemen-produksi/update/{id}', [ProductionController::class, 'update'])->name('manajemen-produksi.update');
    Route::delete('/manajemen-produksi/delete/{id}', [ProductionController::class, 'destroy'])->name('manajemen-produksi.destroy');


    // Manajemen pemesanan
    Route::get('/manajemen-pemesanan', [OrderController::class, 'index'])->name('manajemen-pemesanan.index');
    Route::get('/manajemen-pemesanan/{id}', [OrderController::class, 'show'])->name('manajemen-pemesanan.show');
    Route::put('/manajemen-pemesanan/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
});

Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('manajemen-pemesanan.invoice');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');


require __DIR__ . '/auth.php';



