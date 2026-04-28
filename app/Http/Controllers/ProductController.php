<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller{
    public function index()
{
    // Kita buat array of objects agar bisa di-foreach dan diakses dengan $post->id
    $data = [
        (object) ['id' => 1, 'produk' => 'Laptop'],
        (object) ['id' => 2, 'produk' => 'Mouse'],
    ];

    // Kirim variabel $data ke view
    return view('list_product', compact('data'));
}}
