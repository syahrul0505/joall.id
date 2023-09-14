<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data['products'] = Product::with('category')->get();
        $data['categories'] = Category::all();
        return view('pages.home', $data);
    }
}