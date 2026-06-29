<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('events')->orderBy('nama_kategori')->get();

        return view('admin.kategori.interface', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ], [
            'nama_kategori.required' => 'Category name is required.',
            'nama_kategori.max' => 'Category name cannot exceed 100 characters.',
            'nama_kategori.unique' => 'This category name already exists.',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully added.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
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
