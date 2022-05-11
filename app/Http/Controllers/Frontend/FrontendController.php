<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() 
    {
        $featured_product=Product::where('trending','1')->take(15)->get();
        return view('frontend/dashboard',['feteaured_product'=>$featured_product]);

    }
}
