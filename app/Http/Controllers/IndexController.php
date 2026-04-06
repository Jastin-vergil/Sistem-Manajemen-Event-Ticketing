<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// File: app/Http/Controllers/IndexController.php

class IndexController extends Controller { // Harus IndexController
    public function index() {
        return "Halo ini ngetes"; 
    }
}