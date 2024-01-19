<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $products = Product::all();
        // Pass the converted price and selected currency to the view
        return view('home', compact('products'));
    }
    public function languageDemo(){
        return view('languageDemo');
    }

    public function convert(){
        $products = Product::all();
        // Pass the converted price and selected currency to the view
        return view('convert', compact('products'));
    }


}
