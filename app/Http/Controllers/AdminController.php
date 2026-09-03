<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'admin')->get();
        return view('dashboard/manajemen-admin/index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => ['required', 'string', 'unique:users,phone', 'min:10', 'max:13', 'regex:/^08[1-9][0-9]+$/'],
            'address'  => 'required|string',
        ], [
            'phone.min'   => 'Nomor HP minimal harus 10 angka.',
            'phone.max'   => 'Nomor HP maksimal tidak boleh lebih dari 13 angka.',
            'phone.regex' => 'Format nomor HP tidak valid. Harus diawali dengan angka 08.',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Data akun admin berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Data akun admin berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:6',
            'phone'    => ['required','unique:users,phone,' . $admin->id, 'string', 'min:10', 'max:14', 'regex:/^08[1-9][0-9]+$/'],
            'address' => 'required|string',
        ], [
            'phone.min'   => 'Nomor HP minimal harus 10 angka.',
            'phone.max'   => 'Nomor HP maksimal tidak boleh lebih dari 14 angka.',
            'phone.regex' => 'Format nomor HP tidak valid. Harus diawali dengan angka 08.',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->phone = $request->phone;
        $admin->save();

        return redirect()->back()->with('success', 'Data akun admin berhasil diperbarui');
    }
}
