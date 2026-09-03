<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingRegistrations;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $data = Training::all();
        // jumlah pendaftar
        foreach ($data as $training) {
            $training->registrations_count = TrainingRegistrations::where('training_id', $training->id)->count();
        }
        return view('dashboard.manajemen-pelatihan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'quota' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trainings', 'public');
        }

        Training::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'quota' => $request->quota,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Pelatihan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $training = Training::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'quota' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $training->image = $request->file('image')->store('trainings', 'public');
        }

        $training->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,

            'location' => $request->location,
            'quota' => $request->quota,
        ]);

        return back()->with('success', 'Pelatihan berhasil diupdate');
    }

    public function destroy($id)
    {
        Training::findOrFail($id)->delete();
        return back()->with('success', 'Pelatihan berhasil dihapus');
    }
    public function show($id)
    {
        $data = Training::findOrFail($id);

        $registrations = TrainingRegistrations::where('training_id', $id)->get();
        return view('dashboard.manajemen-pelatihan.detail', compact('data', 'registrations'));
    }

    public function destroyPendaftar($id)
    {
        TrainingRegistrations::findOrFail($id)->delete();
        return back()->with('success', 'Pendaftar berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $training = Training::findOrFail($id);
        $training->status = $request->status;
        $training->save();

        return back()->with('success', 'Status pelatihan berhasil diubah');
    }
}
