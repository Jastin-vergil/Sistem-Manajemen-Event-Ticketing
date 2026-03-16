<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListEventController extends Controller
{
    function tampilkan($id, $nama) 
    {
        return view('list_event', ['id' => $id, 'nama' => $nama]);
    }
}
