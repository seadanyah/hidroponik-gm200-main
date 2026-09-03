<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderCustomerController extends Controller
{
    public function index()
    {
        return view('checkout');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => ['required', 'string', 'min:10', 'max:13', 'regex:/^08[1-9][0-9]+$/'],
                'email' => 'required|email',
                'address' => 'required|string',
            ], [
                'phone.min'   => 'Nomor HP minimal harus 10 angka.',
                'phone.max'   => 'Nomor HP maksimal tidak boleh lebih dari 13 angka.',
                'phone.regex' => 'Format nomor HP tidak valid. Harus diawali dengan angka 08.',
            ]);
            $total = 0;

            foreach ($request->cart as $item) {
                $total += $item['price'] * $item['qty'];
            }

            $orderId = DB::table('orders')->insertGetId([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note,
                'order_date' => now(),
                'total_price' => $total,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach ($request->cart as $item) {

                $product = DB::table('products')
                    ->where('id', $item['id'])
                    ->lockForUpdate()
                    ->first();

                if (!$product || $product->stock < $item['qty']) {
                    throw new \Exception("Stok tidak cukup untuk produk: {$item['name']}");
                }

                DB::table('products')
                    ->where('id', $item['id'])
                    ->update([
                        'stock' => $product->stock - $item['qty']
                    ]);

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $orderId
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // public function store(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $total = 0;
    //         foreach ($request->cart as $item) {
    //             $total += $item['price'] * $item['qty'];
    //         }

    //         $orderId = DB::table('orders')->insertGetId([
    //             'name' => $request->name,
    //             'phone' => $request->phone,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'note' => $request->note,
    //             'order_date' => now(),
    //             'total_price' => $total,
    //             'status' => 'pending',
    //             'created_at' => now(),
    //             'updated_at' => now()
    //         ]);

    //         foreach ($request->cart as $item) {
    //             DB::table('order_items')->insert([
    //                 'order_id' => $orderId,
    //                 'product_id' => $item['id'],
    //                 'quantity' => $item['qty'],
    //                 'price' => $item['price'],
    //                 'created_at' => now(),
    //                 'updated_at' => now()
    //             ]);
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'order_id' => $orderId
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();

    //         return response()->json([
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
