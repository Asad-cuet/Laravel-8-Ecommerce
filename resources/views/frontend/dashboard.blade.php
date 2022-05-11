@extends('layouts.frontend')                                     <!-- showing main component  -->
   
@section('title')
Welcome to E-Shop
@endsection


@section('content')
@include('layouts.front_inc.slider')
      

<div class="py-5">
      <div class="container">
            <div class="row">
                  <h2>Feteared Products</h2>
                  <div class="owl-carousel featured-carousel owl-theme">
                        @foreach ($feteaured_product as $item)
                              <div class="item">
                                    <div class="card">
                                          <img src="{{asset('assets/uploads/product/'.$item->image)}}" alt="Product Image">
                                          <div class="card-body">
                                                <h5>{{$item->name}}</h5>
                                                <span class="float-start">{{$item->selling_price}}</span>
                                                <span class="float-end"><s>{{$item->original_price}}</s></span>
                                          </div>
                                    </div>
                              </div>
                        @endforeach
                  </div>
            </div>
      </div>
</div>

@endsection

@section('scripts')
<script>
      $('.featured-carousel').owlCarousel({
            loop:true,
            margin:10,
            autoplay:true,
           autoplayTimeout:1500,
            autoplayHoverPause:true,
            responsiveClass:true,
            responsive:{
            0:{
                  items:2,
                  nav:true
            },
            600:{
                  items:4,
                  nav:false
            },
            1000:{
                  items:7,
                  nav:true,
                  loop:true
            }
            }
      })

 </script> 
@endsection