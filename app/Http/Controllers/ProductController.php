<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search=request()->get('search-text') ?? null;
        $category=request()->get('search-category') ?? null;

        $data['products']=Product::when($search!=null,function ($item) use ($search){
            $item->where('name','like','%'.$search.'%');
        })->when($category!=null,function ($item) use ($category){

            if($category!="all"){
                $item->whereHas('category',function ($item) use ($category){
                    $item->where('slug',$category);
                });
            }
        })->get();
        return view('products.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product ,$slug)
    {
        $data['product']=Product::where('slug',$slug)->first();
        return view('products.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data['categories'] = Category::all();
        $data['product'] = $product;
        return view('admin.products.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }


    public function ProductByCategory($slug){


        $data['category']=Category::where('slug',$slug)->with('product')->first();

        $data['products']=Product::where('category_id',$data['category']->id)->get();

        return view ('products.index',$data);

    }






}
