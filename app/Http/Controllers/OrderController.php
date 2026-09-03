<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::withCount('items')->latest()->get();
        return view('dashboard.admin.manajemen-pemesanan.index', compact('data'));
    }
    public function show($id)
    {
        $order = Order::with(['items.product' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);

        return view('dashboard.admin.manajemen-pemesanan.detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $order = Order::with('items')->findOrFail($id);

            $oldStatus = $order->status;
            $newStatus = $request->status;


            if ($newStatus === 'dibatalkan' && $oldStatus !== 'dibatalkan') {

                foreach ($order->items as $item) {
                    DB::table('products')
                        ->where('id', $item->product_id)
                        ->increment('stock', $item->quantity);
                }
            }


            if ($oldStatus === 'dibatalkan' && $newStatus !== 'dibatalkan') {

                foreach ($order->items as $item) {

                    $product = DB::table('products')
                        ->where('id', $item->product_id)
                        ->lockForUpdate()
                        ->first();

                    if ($product->stock < $item->quantity) {
                        throw new \Exception("Stok tidak cukup untuk mengaktifkan kembali order");
                    }

                    DB::table('products')
                        ->where('id', $item->product_id)
                        ->decrement('stock', $item->quantity);
                }
            }


            $order->update([
                'status' => $newStatus
            ]);

            DB::commit();

            return back()->with('success', 'Status berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }


    public function invoice($id)
    {
        // $order = Order::with('items.product')->findOrFail($id);
        // $review = Review::where('order_id', $id)->first();
        // $orderItems = $order->items;
        // $namaProduk = $orderItems->map(function ($item) {
        //     return $item->product;
        // })->toArray();

        // nama produk
        $order = Order::with(['items.product' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);

        $review = Review::where('order_id', $id)->first();

        return view('dashboard.admin.manajemen-pemesanan.invoice', compact('order', 'review'));
    }
}
