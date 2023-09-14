<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::all();
        return view('pages.dashboard.categories', $data);
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('image')->store('assets/categories', 'public');
        $data['slug'] = Str::slug($request->name);
        Category::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request)
    {
        if($request->get('category_id')){
            $product = Category::find($request->get('category_id'));
            $data['name'] = $request->name;
            $data['slug'] = Str::slug($request->name);
            if($request->image) {
                $data['photos'] = $request->file('image')->store('assets/categories', 'public');
                Storage::disk('public')->delete($product->photos);
            }
            $product->update($data);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        Storage::disk('public')->delete($item->photos);
        $item->delete();

        return redirect()->back();
    }

    public function getCategoryById($id) {
        $category = Category::findOrFail($id);
        return response()->json([ 'category' => $category ]);
    }
}