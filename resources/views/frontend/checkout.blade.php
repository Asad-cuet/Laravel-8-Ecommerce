@extends('layouts.frontend')                                     <!-- showing main component  -->
   
@section('title')
Checkout Page
@endsection


@section('content')

<div class="container mt-5">
   <form action="{{url('/place-order')}}" method="POST">
      @csrf  
      <div class="row">
            <div class="col-md-5">
                  <div class="card">
                        <div class="card-body">
                              <h6>Basic Details</h6>
                              <hr>
                              <div class="row checkout-form">
                                    <div class="col-md-6">
                                          <label for="">First Name</label>
                                          <input required type="text" name="fname" value="{{Auth::user()->fname}}" class="form-control" placeholder="Enter First Name">
                                    </div>
                                    <div class="col-md-6">
                                          <label for="">Last Name</label>
                                          <input required type="text" name="lname" value="{{Auth::user()->lname}}" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Email</label>
                                          <input required type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Phone number</label>
                                          <input required type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Address 1</label>
                                          <input required type="text" name="address1" value="{{Auth::user()->address1}}" class="form-control" placeholder="Enter Address 1">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Address 2</label>
                                          <input type="text" name="address2" value="{{Auth::user()->address2}}" class="form-control" placeholder="Enter Address 2">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">City</label>
                                          <input required type="text" name="city" value="{{Auth::user()->city}}" class="form-control" placeholder="Enter City">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">State</label>
                                          <input required type="text" name="state" value="{{Auth::user()->state}}" class="form-control" placeholder="Enter State">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Country</label>
                                          <input required type="text" name="country" value="{{Auth::user()->country}}" class="form-control" placeholder="Enter Country">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Pin Code</label>
                                          <input required type="password" name="pincode" value="{{Auth::user()->pincode}}" class="form-control" placeholder="Enter Pin Code">
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="col-md-7">
                  <div class="card">
                        <div class="card-body">
                              Order Details
                              <hr>
                              <table class="table table-striped table-bordered">
                                    <thead>
                                          <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @php $total=0; @endphp
                                          @foreach ($cartitems as $item)
                                              <tr>
                                                    <td>{{$item->product->name}}</td>
                                                    <td>{{$item->prod_qty}}</td>
                                                    <td>{{$item->product->selling_price}}</td>
                                              </tr>
                                          @php $total+=($item->product->selling_price)*($item->prod_qty); @endphp    
                                          @endforeach
                                    </tbody>
                              </table>
                              <h6>Total : Rs {{$total}}</h6>
                              <hr>
                              <button type="submit " class="btn btn-primary w-100">Place Order</button>
                        </div>
                  </div>
            </div>
      </div> 
   </form>   
</div>
@endsection

@section('scripts')
 
@endsection