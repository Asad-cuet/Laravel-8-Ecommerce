<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class SslCommerzPaymentController extends Controller
{






    public function payViaAjax(Request $request)
    {
        if(!Cart::where('user_id',Auth::id())->exists())
         {
            return redirect('/')->with('status','Add Product to Cart first!');
         }


        $requestData=(array) json_decode($request->cart_json);


        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.


        $post_data = array();
        $post_data['total_amount'] = $requestData['total']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $requestData['fname'].' '.$requestData['lname'];
        $post_data['cus_email'] = $requestData['email'];
        $post_data['cus_add1'] = $requestData['address1'];
        $post_data['cus_add2'] = $requestData['address2'];
        $post_data['cus_city'] = $requestData['city'];
        $post_data['cus_state'] = $requestData['state'];
        $post_data['cus_postcode'] = $requestData['pincode'];
        $post_data['cus_country'] = $requestData['country'];
        $post_data['cus_phone'] = $requestData['phone'];

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "E-Shop";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "01781856861";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";




        
        $order=new Order();
        $order->user_id = Auth::id();
        $order->fname = $requestData['fname'];
        $order->lname = $requestData['lname'];
        $order->email = $requestData['email'];
        $order->phone = $requestData['phone'];
        $order->address1 = $requestData['address1'];
        $order->address2 = $requestData['address2'];
        $order->city = $requestData['city'];
        $order->state = $requestData['state'];
        $order->country = $requestData['country'];
        $order->pincode = $requestData['pincode'];
        $order->total_price = $requestData['total'];
        $order->tracking_no = 'asad'.rand(1111,9999);

        $order->payment_mode="Paid by SSL";
        $order->payment_id=$post_data['tran_id'];
        $order->save();




        $cartitems=Cart::where('user_id',Auth::id())->get();      
        foreach($cartitems as $item)
        {
            OrderItem::create([
                'order_id'=>$order->id,
                'prod_id'=>$item->prod_id,
                'qty'=>$item->prod_qty,
                'price'=>$item->product->selling_price,
            ]);

            //reducing quantity
            $prod=Product::where('id',$item->prod_id)->first();
            $prod->qty=$prod->qty - $item->prod_qty;
            $prod->update();
        } 


        if(Auth::user()->address1==NULL)
        {
            $user=User::where('id',Auth::id())->first();
            $user->fname = $requestData['fname'];
            $user->lname = $requestData['lname'];
            $user->phone = $requestData['phone'];
            $user->address1 = $requestData['address1'];
            $user->address2 = $requestData['address2'];
            $user->city = $requestData['city'];
            $user->state = $requestData['state'];
            $user->country = $requestData['country'];
            $user->pincode = $requestData['pincode'];
            $user->update();
        }





        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

  
         
         $cartitems=Cart::where('user_id',Auth::id())->get();
         Cart::destroy($cartitems);

         
         return redirect('/my-orders')->with('status','Order Placed Successfully');

 


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
