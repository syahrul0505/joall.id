<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\AddonCartDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $data['carts'] = Cart::with(['user', 'product'])->where('user_id', auth()->user()->id)->get();
        $data['addons'] = AddonCartDetail::with(['addon', 'cart'])->where('user_id', auth()->user()->id)->get();
        return view('pages.cart', $data);
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $cart = Cart::create($data);
        
        $cart_addon = [];
        if($request->has('addons')) {
            foreach($request->addons as $key => $items)
                {
                    $cart_addon []= [
                        'cart_id'   => $cart->id,
                        'addon_id'  => $request->addons[$key],
                        'user_id' => auth()->user()->id,
                    ];
                }
            AddonCartDetail::insert($cart_addon);
        }
        return redirect()->back();
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
    }
}