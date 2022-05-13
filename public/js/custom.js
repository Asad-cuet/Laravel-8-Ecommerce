$(document).ready(function(){


       $.ajaxSetup({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

            $('.addToCartBtn').click(function(e){
               e.preventDefault();
               var product_id=$(this).closest('.product_data').find('.prod_id').val();
               var product_qty=$(this).closest('.product_data').find('.qty-input').val();
               
      

               $.ajax({
                     method:"POST",
                     url:"/add-to-cart",
                     data:{
                           'product_id':product_id,
                           'product_qty':product_qty,
                     },
                     success:function(response,res) {
                          //alert(res);
                          swal(response.status);
                          
                          
                     }
               });
            });



            $('.increment-btn').click(function(e){
                  e.preventDefault();

                  var inc_value=$(this).closest('.product_data').find('.qty-input').val();
                  var value=parseInt(inc_value,10);
                  value=isNaN(value) ? 0:value;
                  if(value<10)
                  {
                        value++;
                        $(this).closest('.product_data').find('.qty-input').val(value);
                  }
            });


            $('.decrement-btn').click(function(e){
                  e.preventDefault();

                  var dec_value=$(this).closest('.product_data').find('.qty-input').val();
                  var value=parseInt(dec_value,10);
                  value=isNaN(value) ? 0:value;
                  if(value>1)
                  {
                        value--;
                        $(this).closest('.product_data').find('.qty-input').val(value);
                  }
            });


            $('.delete-cart-item').click(function(e){
                  e.preventDefault();

                  var cart_id=$(this).closest('.product_data').find('.cart_id').val();




                  $.ajax({
                        method:"POST",
                        url:"/delete-cart-item",
                        data:{
                              'cart_id':cart_id
                        },
                        success:function(response) {
                        swal("",response.status, "success");
                        }
                  });

            });

            $('.changeQuantity').click(function(e){
                  e.preventDefault();

                  var cart_id=$(this).closest('.product_data').find('.cart_id').val();
                  var qty=$(this).closest('.product_data').find('.qty-input').val();




                  $.ajax({
                        method:"POST",
                        url:"/update-cart",
                        data:{
                              'cart_id':cart_id,
                              'prod_qty':qty,
                        },
                        success:function(response) {
                        $('.total').html(response.status);
                        //console.log(response.status);
                        }
                  });

            });



            

});