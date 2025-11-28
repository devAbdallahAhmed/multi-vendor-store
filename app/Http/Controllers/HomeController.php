<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    public function index()
    {
        $products = Product::with('category')->active()->latest()->take(8)->get();

        return view('front.home', compact('products'));
    }
}
