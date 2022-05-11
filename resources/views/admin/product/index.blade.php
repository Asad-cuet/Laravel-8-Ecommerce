@extends('layouts.admin')                                     <!-- showing main component  -->
             
@section('content')
<div class="card">
      <div class="card-body">
             <div class="col-md-12">    
                  <a href="{{url('products/insert_form')}}" class="btn btn-primary">Add Product</a>
             </div> 



             <table class="table">
                   <thead>
                         <tr>
                               <th>Id</th>
                               <th>Name</th>
                               <th>Category</th>
                               <th>Image</th>
                               <th>Original Price</th>
                               <th>Selling Price</th>
                               <th>Quantity</th>
                               <th>Tax</th>
                               <th>Status</th>
                               <th>Trending</th>
                               <th>Action</th>
                         </tr>
                  </thead>
                  <tbody>
                        @foreach ($product as $item)
                        <tr>
                              <td>{{$item->id}}</td>              
                              <td>{{$item->name}}</td> 
                              <td>{{$item->category->name}}</td> 
                              <td><img src="{{asset('assets/uploads/product/'.$item->image)}}" style="max-width:70px;"></td>                           
                              <td>{{$item->original_price}}</td>              
                              <td>{{$item->selling_price}}</td>              
                              <td>{{$item->qty}}</td>              
                              <td>{{$item->tax}}</td>              
                              <td>{{$item->status}}</td>              
                              <td>{{$item->trending}}</td>              
                              <td>
                                    <a href="{{url('products/edit/'.$item->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('products/delete/'.$item->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                              </td>              
                        </tr>
                        @endforeach

                  </tbody>
            </table>                                
      </div>
</div>



@endsection