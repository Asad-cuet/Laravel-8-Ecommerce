@extends('layouts.frontend')                                     <!-- showing main component  -->
   
@section('title')
My Cart
@endsection


@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
      <div class="container">
            <h6 class="mb-0">Cart</h6>      
      </div>       
</div>  



<div class="container my-5">
      <div class="card shadow">
            <div class="card-body">
                  @foreach ($product as $item)
                  <div class="row product_data">
     
                        <div class="col-md-2">
                              <img src="{{asset('assets/uploads/product/'.$item->product->image)}}" height="70px" width="70px" alt="Image">
                        </div>
                        <div class="col-md-5">
                             {{$item->product->name}}
                        </div>
                        <div class="col-md-3">
                              <input type="hidden" value="{{$item->id}}" class="cart_id">
                              <label for="quantity">Quantity</label>
                              <div class="input-group text-center mb-3" style="width:130px;">
                                     <button class="input-group-text decrement-btn">-</button>
                                     <input type="text" name="quantity" value="{{$item->prod_qty}}" class="form-control qty-input text-center" />
                                     <button class="input-group-text increment-btn">+</button>      
                              </div>       
                        </div>
                        <div class="col-md-2">
                              <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i>Remove</button>
                        </div>
                         
                  </div>
                  @endforeach
            </div>
      </div>
</div>

@endsection

@section('scripts')
<script>


</script>
@endsection