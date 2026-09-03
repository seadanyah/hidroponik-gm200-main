<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $data = Review::latest()->get();
        return view('dashboard.manajemen-review.index', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'tampil' => 'required|in:ya,tidak'
        ]);

        $review = Review::findOrFail($id);

        $review->update([
            'tampil' => $request->tampil
        ]);

        return back()->with('success', 'Status berhasil diubah!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'name' => 'required',
            'phone'    => ['required', 'string', 'min:10', 'max:13', 'regex:/^08[1-9][0-9]+$/'],
            'review' => 'required',
            'rating' => 'required'
        ], [
            'phone.min'   => 'Nomor HP minimal harus 10 angka.',
            'phone.max'   => 'Nomor HP maksimal tidak boleh lebih dari 13 angka.',
            'phone.regex' => 'Format nomor HP tidak valid. Harus diawali dengan angka 08.',
        ]);

        $existing = Review::where('order_id', $request->order_id)->first();

        if ($existing) {

            if ($existing->created_at->diffInHours(now()) > 24) {
                return back()->with('error', 'Review tidak bisa diedit (lebih dari 24 jam)');
            }

            $existing->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'review' => $request->review,
                'rating' => $request->rating,
            ]);
        } else {

            Review::create([
                'order_id' => $request->order_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'review' => $request->review,
                'rating' => $request->rating,
                'tampil' => 'ya'
            ]);
        }

        return back()->with('success', 'Review berhasil disimpan!');
    }
}
