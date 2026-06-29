<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('events')->orderBy('nama')->get();

        return view('admin.kategori.interface', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama',
        ], [
            'nama.required' => 'Category name is required.',
            'nama.max' => 'Category name cannot exceed 100 characters.',
            'nama.unique' => 'This category name already exists.',
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully added.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama,' . $kategori->id,
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully updated.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully deleted.');
    }
}
