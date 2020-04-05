<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Product;
use App\Order;
use App\RelatedProduct;

class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show', 'search']]);
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
    public function create($subcategoryID)
    {
        if(auth()->user()->isAdmin()){
            return view('pages.products.create')->with('subcategoryID', $subcategoryID);
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
                'prod_code'=>'required',
                'prod_name'=>'required',
                'prod_unit'=>'required',
                'prod_currency'=>'required',
                'prod_price'=>'required'
            ]);
            
            // Create product
            $product = new Product;
            $product->code = $request->input('prod_code');
            $product->name = $request->input('prod_name');
            $product->unit = $request->input('prod_unit');
            $product->price = $request->input('prod_price');
            $product->currency = $request->input('prod_currency');
            $product->subcategory_id = $request->input('prod_subcategory');
            $product->save();
            return redirect('subcategories/'.$product->subcategory_id);
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
        $product = Product::find($id);
        if($product === null) abort(404);

        // If client, get discount
        if(auth()->user() && auth()->user()->isClient())
            $product->price = $product->getPriceWithDiscount(auth()->user());
        
        $data = array(
            'product' => $product,
            'documents' => $product->product_files->where('type', 'document'),
            'images' => $product->product_files->where('type', 'image')
        );

        return view('pages.products.show')->with($data);
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
            $product = Product::find($id);
            if($product === null) abort(404);
            return view('pages.products.edit') -> with('product', $product);
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
                'prod_code'=>'required',
                'prod_name'=>'required',
                'prod_unit'=>'required',
                'prod_currency'=>'required',
                'prod_price'=>'required'
            ]);

            $product = Product::find($id);
            if($product === null) abort(404);
            $product->code = $request->input('prod_code');
            $product->name = $request->input('prod_name');
            $product->unit = $request->input('prod_unit');
            $product->price = $request->input('prod_price');
            $product->currency = $request->input('prod_currency');
            $product->subcategory_id = $request->input('prod_subcategory');
            $product->save();
            return redirect('subcategories/'.$product->subcategory_id);
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
            $product = Product::find($id);
            if($product === null) abort(404);
            $subcategoryID = $product->subcategory_id;
            $product->delete();
            return redirect('subcategories/'.$subcategoryID);
        }
        else abort(404);
    }
}