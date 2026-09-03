<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelCustomerController extends Controller
{
    public function show($slug)
    {

        $artikel = Article::all()->first(function ($item) use ($slug) {
            return Str::slug($item->title) === $slug;
        });

        return view('detail-artikel', compact('artikel'));
    }
}
