<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index() 
    {
        $feteared_product=Product::where('trending','1')->take(15)->get();
        $trending_category=Category::where('popular','1')->take(15)->get();
        return view('frontend/dashboard',['feteaured_product'=>$feteared_product,'trending_category'=>$trending_category]);

    }
    public function category() 
    {
        $category=Category::all();
        return view('frontend/category',['category'=>$category]);

    }


    public function view_category($slug) 
    {
        if($category=Category::where('slug',$slug)->exists())
        {
            $category=Category::where('slug',$slug)->first();
            $product=Product::where('cate_id',$category->id)->orderBy('id','DESC')->get();
            return view('frontend/view-category',['product'=>$product,'category'=>$category]);
        }
        else
        {
            return view('frontend/dashboard')->with("status","Slug doesn't exist");
        }
    }

    public function view_product($cate_slug,$prod_slug)
    {
        if(Category::where('slug',$cate_slug)->exists())
        {
            if(Product::where('slug',$prod_slug)->exists())
            {
                $product=Product::where('slug',$prod_slug)->first();
                $rating=Rating::where('prod_id',$product->id)->get();
                $rating_sum=Rating::where('prod_id',$product->id)->sum('stars_rated');
                $user_rating=Rating::where('prod_id',$product->id)->where('user_id',Auth::id())->first();
                if($rating->count()>0)
                {
                    $rating_value=$rating_sum/$rating->count();
                }
                else
                {
                    $rating_value=0;
                }
                
                return view('frontend/view-product',['product'=>$product,'rating'=>$rating,'rating_value'=>$rating_value,'user_rating'=>$user_rating]);
            }
            else
            {
                return view('frontend/view-product')->with('status','No such product found');
            }
        }
        else
        {
        return view('frontend/view-product')->with('status','No such Category found');
        }
    }
}
