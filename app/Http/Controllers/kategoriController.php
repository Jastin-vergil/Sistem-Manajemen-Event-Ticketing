<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
{
    $kategori = Kategori::withCount('events')->orderBy('nama')->get();
    return view('admin.kategori.interface', compact('kategori'));
}

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100|unique:kategori,nama']);
        Kategori::create($request->only('nama'));
        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully added.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['nama' => 'required|string|max:100|unique:kategori,nama,' . $kategori->id]);
        $kategori->update($request->only('nama'));
        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully updated.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Category successfully deleted.');
    }
}