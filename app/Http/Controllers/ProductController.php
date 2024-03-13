<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Rules\Titlecase;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', new Titlecase],
            'slug' => ['required', 'alpha_dash', Rule::unique('products', 'slug')],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'image' => ['nullable', 'image']
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->slug = $validated['slug'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];

        if($request->hasFile('image')) {
            $product->image = $request->image->store('images', 'public');
        }

        $product->save();

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select(['id', 'name'])->get();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'alpha_dash', Rule::unique('products', 'slug')->ignore($id)],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'image' => ['nullable', 'image']
        ]);

        $product = Product::findOrFail($id);
        $product->name = $validated['name'];
        $product->slug = $validated['slug'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];
        if($request->hasFile('image')) {
            $oldImage = $product->image;
            $product->image = $request->image->store('images', 'public');
        }
        $product->save();

        if(Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = $product->image;
        $product->delete();

        if(Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }

        return redirect(route('products.index'));
    }
}
