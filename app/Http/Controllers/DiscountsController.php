<?php

namespace App\Http\Controllers;

use App\discount;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isClient()){
            $discounts = Discount::where('user_id', auth()->user()->id)->orderBy('discount', 'desc')->get();
            foreach($discounts as $discount){
                $discount->subcategory = $discount->getSubcategory();
            }
            return view('pages.discounts.index')->with('discounts', $discounts);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(discount $discount)
    {
        if(auth()->user()->isAdmin()){
            $user = User::find($userID);
            if($user === null || !($user->isClient())) abort(404);

            $subcategories = Subcategory::all();

            $data = array(
                'user'=>$user,
                'subcategories'=>$subcategories
            );

            foreach($data['subcategories'] as $subcategory){
                $subcategory->discount = $user->getDiscount($subcategory);
            }

            return view('pages.discounts.edit')->with($data);
        }
        else abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(discount $discount)
    {
        //
    }
}
