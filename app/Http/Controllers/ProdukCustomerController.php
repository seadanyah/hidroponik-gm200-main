<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukCustomerController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $admin = User::where('role', 'admin')->first();

        return view('detail-produk', compact('product','admin'));
    }
}
