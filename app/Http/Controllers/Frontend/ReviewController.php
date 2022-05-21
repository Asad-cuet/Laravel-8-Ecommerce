<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
{
    public function index($slug)
    {
          $product_check=Product::where('slug',$slug)->where('status',0)->first();

          if($product_check)
          {
              $product_id=$product_check->id;
              $verified_purchase=Order::where('orders.user_id',Auth::id())
                                        ->join('order_items','orders.id','order_items.order_id')
                                        ->where('order_items.prod_id',$product_id)->get();
              return view('frontend.review.index',['product'=>$product_check,'verified_purchase'=>$verified_purchase]);
          }
          else
          {
              return redirect()->back()->with('status',"The link you followed was broken");
          }
    }
}
