<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $data['carts'] = Cart::with(['user', 'product'])->where('user_id', auth()->user()->id)->get();
        return view('pages.cart', $data);
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Cart::create($data);
        return redirect()->back();
    }
}