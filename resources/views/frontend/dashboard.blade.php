@extends('layouts.frontend')                                     <!-- showing main component  -->
   
@section('title')
Welcome to E-Shop
@endsection


@section('content')
@include('layouts.front_inc.slider')
      

<div class="py-5">
      <div class="container">
            <div class="row">
                  <h2>Featured Products</h2>
                  <div class="owl-carousel featured-carousel owl-theme">
                        @foreach ($feteaured_product as $item)
                        <a href="{{url('category/'.$item->category->slug.'/'.$item->slug)}}" >
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
                        </a>      
                        @endforeach
                  </div>
            </div>
      </div>
</div>


<div class="py-5">
      <div class="container">
            <div class="row">
                  <h2>Trending Category</h2>
                  <div class="owl-carousel category-carousel owl-theme">
                        @foreach ($trending_category as $item)
                             <a href="{{url('category/'.$item->slug)}}" >
                              <div class="item">
                                    <div class="card">
                                          <img src="{{asset('assets/uploads/category/'.$item->image)}}" alt="Product Image">
                                          <div class="card-body">
                                                <h5>{{$item->name}}</h5>
                                          </div>
                                    </div>
                              </div>
                              </a>
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
            dots:false,
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
      $('.category-carousel').owlCarousel({
            loop:true,
            margin:10,
           // autoplay:true,
           // autoplayTimeout:1500,
           // autoplayHoverPause:true,
            dots:false,
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