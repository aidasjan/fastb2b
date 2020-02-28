<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Discount;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isClient() || true){
            return view('pages.client.dashboard');
        }

        else if(auth()->user()->isAdmin()) {
            
        }

        else abort(404);
    }
}
