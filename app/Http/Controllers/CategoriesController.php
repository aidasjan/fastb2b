<?php

namespace App\Http\Controllers;

use App\category;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**	
     * Create a new controller instance.	
     *	
     * @return void	
     */	
    public function __construct()	
    {	
        $this->middleware('auth', ['except'=>['index', 'show']]);	
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();	
        $discount_subcategories = Subcategory::where('discount', '>', 0)->orderBy('discount', 'desc')->get();	
        $data = array(	
            'categories'=>$categories,	
            'discount_subcategories'=>$discount_subcategories	
        );	
        return view('pages.categories.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->isAdmin()){	
            return view('pages.categories.create');	
        }	
        else abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()){	
            $this->validate($request,[	
                'categ_name'=>'required'	
            ]);	
            	
            // Create category	
            $category = new Category;	
            $category->name = $request->input('categ_name');	
            $category->save();	
            return redirect('/');	
        }	
        else abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
