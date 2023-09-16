<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $data['products'] = Product::with('category')->get();
        $data['categories'] = Category::all();
        $data['addons'] = Addon::all();
        if(Auth::check()) {
            $data['carts'] = Cart::where('user_id', auth()->user()->id)->get();
        }
        return view('pages.home', $data);
    }
}