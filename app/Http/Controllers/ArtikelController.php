<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $data = Article::with('author')->get();
        return view('dashboard/manajemen-artikel/index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect('/manajemen-artikel')->with('success', 'Data artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('dashboard/manajemen-artikel/edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/manajemen-artikel')->with('success', 'Data artikel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect('/manajemen-artikel')->with('success', 'Data artikel berhasil dihapus');
    }

    public function create()
    {
        return view('dashboard/manajemen-artikel/tambah');
    }

    public function show($id)
    {
        $data = Article::with('author')->findOrFail($id);
        return view('dashboard/manajemen-artikel/detail', compact('data'));
    }
}
