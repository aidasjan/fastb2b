<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use App\User;
use App\Subcategory;

class DiscountsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()){

            $this->validate($request,[
                'dis_user'=>'required'
            ]);

            // Get and validate user
            $userID = $request->input('dis_user');
            $user = User::find($userID);
            if($user === null || !($user->isClient() || $user->isNewClient())) abort(404);

            // Get client's discounts
            $user_discounts = $user->getAllDiscounts();

            $inputs = $request->all();
            foreach($inputs as $key=>$value){
                // Validate inputs
                $subcategory = Subcategory::find($key);
                if($subcategory !== null){

                    if(!(is_numeric($value) || $value=='')) abort(404); // If value is not valid

                    // If discount is already set
                    if($user_discounts->where('subcategory_id', $key)->first() !== null){
                        $discount = $user_discounts->where('subcategory_id', $key)->first();
                        if($value > 0){
                            $discount->discount = $value;
                            $discount->save();
                        }
                        else{
                            $discount->delete();
                        }
                    }
                    // If discount is new
                    else{
                        if($value > 0){
                            $discount = new Discount;
                            $discount->user_id = $user->id;
                            $discount->subcategory_id = $key;
                            $discount->discount = $value;
                            $discount->save();
                        }
                    }
                }
            }

            return redirect('/users');
        }
        else abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userID)
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

}
