    @extends('layout')
    @section('content')
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::TO('/')}}">Home</a></li>
              <li class="active">Shopping Cart</li>
          </ol>
      </div>
      <?php if (Session::has('cart') == false||count(session::get('cart')->list)==0): ?>
          <h3 class=""><?php echo "Your cart is empty!" ?></h3>
          <?php else: ?>
              <div class="col-sm-9">
                <form action="{{URL::TO('/update_cart')}}" method="POST">
                     {{ csrf_field() }}
                  <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu" > 
                                <td class="image" style="width:100px">Image</td>
                                <td class="description" style="width: 200px">description</td>
                                <td class="price">Price</td>
                                <td class="quantity" style="width: 200px" >Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>              
                            <?php foreach (Session::get('cart')->list as $key => $value):  ?>
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img style="width: 50px;height:50px;margin-left: -10px;" src="{{URL::to('public/upload/products/'.trim($value['info']->thumbnail))}}" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="{{URL::to('/detail/'.$value['info']->productID)}}">{{$value['info']->productName}}</a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>đ {{number_format($value['info']->unitPrice)}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">                                          
                                        <input class="cart_quantity_input" min="1" max="{{$value['info']->quantity}}"  type="number" data-prid="{{$value['info']->productID}}" name="<?php echo $value['info']->productID; ?>" value="{{$value['quantity']}}" autocomplete="off" size="2">
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">đ {{number_format(0.01*$value['info']->unitPrice*(100-$value['info']->discount)*$value['quantity'])}}</p>
                                    </td>   

                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{url::to('/delcart/'.$value['info']->productID)}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?> 
                        </tbody>
                    </table>
                    
                    <div class="col-sm-4">
                        <div class="total_area">
                            <ul>
                                <?php $total = 0 ?>
                                <?php foreach (session::get('cart')->list as $key => $value): ?>
                                    <?php   $total+=0.01*$value['info']->unitPrice*(100-$value['info']->discount)*$value['quantity']; ?>

                                <?php endforeach ?>
                                <li>Total <span>{{(number_format($total))}}</span></li>
                            </ul>
                            <input type="submit" name="" class="btn btn-default update" id="" value="Update">
                            {{-- <input <a class="btn btn-default update" href="{{URL::TO('/update_cart')}}">Update</a> > --}}
                            <a class="btn btn-default check_out" href=" {{URL::TO('/order')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>

    <?php endif ?>
     </div>
    @endsection