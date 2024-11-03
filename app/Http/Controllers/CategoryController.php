<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories']=Category::simplePaginate(2);
        return view('admin.categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'name'=>'required|unique:categories,title',
            'logo'=>'required',
        ]) ;

        $category=Category::create([
            'title'=>request('name'),
        ]);

        $category ->addMedia($request->file('logo'))
            ->toMediaCollection('category_logo');

        return redirect()->route('admin.categories.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data['category']=$category;
        return view('admin.categories.create',$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=>'required|unique:categories,title',

        ]);
        $category->update([
            'title'=>request('name'),
        ]);
        return redirect()->route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
