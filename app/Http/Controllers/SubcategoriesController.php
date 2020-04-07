<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Product;
use App\OrderProduct;
use App\Order;

class SubcategoriesController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoryID)
    {
        if(auth()->user()->isAdmin()){
            return view('pages.subcategories.create')->with('categoryID', $categoryID);
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
                'subcateg_name'=>'required',
            ]);
            
            // Create subcategory
            $subcategory = new Subcategory;
            $subcategory->name = $request->input('subcateg_name');
            $subcategory->category_id = $request->input('subcateg_category');
            $subcategory->save();
            return redirect('categories/'.$subcategory->category_id);
        }
        else abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = Subcategory::find($id);
        if($subcategory === null) abort(404);

        $data = array(
            'products' => $subcategory->products,
            'subcategory' => $subcategory,
            'headline' => $subcategory->name
        );

        // Set discounts
        if(auth()->user() && auth()->user()->isClient()){
            // Set discount for subcategory
            $data['discount'] = auth()->user()->getDiscount($subcategory);
            // Set discounts for products
            foreach($data['products'] as $product){
                $product->price = $product->getPriceWithDiscount(auth()->user());
            }
        }
            
        return view('pages.products.index')->with($data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->isAdmin()){
            $subcategory = Subcategory::find($id);
            if($subcategory === null) abort(404);
            return view('pages.subcategories.edit') -> with('subcategory', $subcategory);
        }
        else abort(404);
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
        if(auth()->user()->isAdmin()){
            $this->validate($request,[
                'subcateg_name'=>'required',
            ]);
            
            $subcategory = Subcategory::find($id);
            if($subcategory === null) abort(404);
            $subcategory->name = $request->input('subcateg_name');
            $subcategory->category_id = $request->input('subcateg_category');
            $subcategory->save();
            return redirect('categories/'.$subcategory->category_id);
        }
        else abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->isAdmin()){
            $subcategory = Subcategory::find($id);
            if($subcategory === null) abort(404);
            $categoryID = $subcategory->category_id;

            foreach($subcategory->products as $product){
                $product->delete();
            }
            
            $subcategory->delete();
            return redirect('categories/'.$categoryID);
        }
        else abort(404);
    }
}