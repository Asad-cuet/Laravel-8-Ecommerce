@extends('layouts.frontend')                                     <!-- showing main component  -->
   
@section('title')
Checkout Page
@endsection


@section('content')

<div class="container mt-5">
      <div class="row">
            <div class="col-md-7">
                  <div class="card">
                        <div class="card-body">
                              <h6>Basic Details</h6>
                              <hr>
                              <div class="row checkout-form">
                                    <div class="col-md-6">
                                          <label for="">First Name</label>
                                          <input type="text" class="form-control" placeholder="Enter First Name">
                                    </div>
                                    <div class="col-md-6">
                                          <label for="">Last Name</label>
                                          <input type="text" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Email</label>
                                          <input type="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Phone number</label>
                                          <input type="text" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Address 1</label>
                                          <input type="text" class="form-control" placeholder="Enter Address 1">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Address 2</label>
                                          <input type="text" class="form-control" placeholder="Enter Address 2">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">City</label>
                                          <input type="text" class="form-control" placeholder="Enter City">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">State</label>
                                          <input type="text" class="form-control" placeholder="Enter State">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Country</label>
                                          <input type="text" class="form-control" placeholder="Enter Country">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                          <label for="">Pin Code</label>
                                          <input type="password" class="form-control" placeholder="Enter Pin Code">
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="col-md-5">
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
                                          @foreach ($cartitems as $item)
                                              <tr>
                                                    <td>{{$item->product->name}}</td>
                                                    <td>{{$item->prod_qty}}</td>
                                                    <td>{{$item->product->selling_price}}</td>
                                              </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                              <hr>
                              <button class="btn btn-primary float-end">Place Order</button>
                        </div>
                  </div>
            </div>
      </div> 
</div>
@endsection

@section('scripts')
 
@endsection