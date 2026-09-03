<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $data = Production::latest()->get();

        return view('dashboard.admin.manajemen-produksi.index', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'plant_name' => 'required',
            'planting_date' => 'required|date',
            'harvest_date' => 'required|date',
            'quantity' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        Production::create($request->all());

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = Production::findOrFail($id);

        $request->validate([
            'plant_name' => 'required',
            'planting_date' => 'required|date',
            'harvest_date' => 'required|date',
            'quantity' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $item->update([
            'plant_name' => $request->plant_name,
            'planting_date' => $request->planting_date,
            'harvest_date' => $request->harvest_date,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Production::destroy($id);
        return back()->with('success', 'Data dihapus');
    }
}
