<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::with('category')->get();
        $data['categories'] = Category::all();
        return view('pages.dashboard.products', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/products', 'public');
        $data['slug'] = Str::slug($request->name);
        Product::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        if($request->get('product_id')){
            $product = Product::find($request->get('product_id'));
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            if($request->photos != '') {
                $data['photos'] = $request->file('photos')->store('assets/products', 'public');
                Storage::disk('public')->delete($product->photos);
            }else{
                $data['photos'] = $product->photos;
            }
            $product->update($data);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        Storage::disk('public')->delete($item->photos);
        $item->delete();

        return redirect()->back();
    }

    public function getProductById($id) {
        $product = Product::with('category')->findOrFail($id);
        $data = strip_tags($product->description);
        return response()->json([ 'product' => $product, 'data' => $data ]);
    }
}