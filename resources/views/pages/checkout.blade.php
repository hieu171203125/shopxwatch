@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->


		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-8">
					<div class="shopper-info">
						<p>Shopper Information</p>
            <form action="{{URL::TO('/confirmOrder')}}" method="post">
              {{ csrf_field() }}
              <label>Name</label>
              <input type="text" name="fullName" class="username-cus" placeholder="User Name" value="{{Session::get('customer')->fullName}}" required>
              <input type="text" hidden="true" name="customerID" class="username-cus" placeholder="User Name" value="{{Session::get('customer')->customerID}}" required>

              <label>Email</label>
              <input required type="email" name="email" class="email-cus" placeholder="email" value="{{Session::get('customer')->email}}">

              <label>Phone</label>
              <input required type="tel" name="phone" name="phone" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" class="phone-cus" placeholder="0123-456-789" value="{{Session::get('customer')->phone}}">

              <label>Address</label>
              <input required type="text" name="address" class="address-cus" placeholder="Address" value="{{Session::get('customer')->address}}" >
              
<?php if (Session::has('cart')): ?>
              <?php $total = 0 ?>
              <?php foreach (session::get('cart')->list as $key => $value): ?>
                <?php  $total += $value['total']; ?>
              <?php endforeach ?>
              <label>Total</label>
              <input type="text" placeholder="Address"  value="{{number_format($total)}}" readonly>
<?php else: ?>
     <?php echo "Bạn chưa thêm sản phẩm nào vào giỏ hàng" ?>
<?php endif ?>

              <p>Shipping Order</p>

               <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea> 

              <a class="btn btn-primary" href="{{URL::TO('/')}}"> Continue Shopping </a>
              
              <button type="submit" class="btn btn-primary"> Confirm </button>
            </form>



          </div> 
        </div>
      </div>  
    </div>
    <div class="review-payment">
     <h2>   Review & Payment  </h2>
   </div>

  </div>
</section> <!--/#cart_items-->
<?php if (Session::has('cart') == false): ?>
    <?php echo "Bạn chưa thêm sản phẩm nào vào giỏ hàng" ?>
    <?php else: ?>
      <div class="col-sm-10">
        <div class="table-responsive cart_info">
          <table class="table table-condensed">
            <thead>
              <tr class="cart_menu" >
                <td class="image" style="width:100px">Image</td>
                <td class="description" style="width: 200px">description</td>
                <td class="price">Price</td>
                <td class="quantity" style="width: 100px" >Quantity</td>
                <td class="total">Total</td>
                <td></td>
              </tr>
            </thead>
            <tbody>              
              <?php foreach (Session::get('cart')->list as $list => $value):  ?>
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img style="width: 50px;height:50px;margin-left: -10px;" src="{{URL::to('public/upload/products/'.$value['info']->thumbnail)}}" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{$value['info']->productName}}</a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>đ {{number_format($value['info']->unitPrice)}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">                                          
                                            <input class="cart_quantity_input"  type="text" name="quantity" value="{{$value['quantity']}}" autocomplete="off" size="2">
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <?php $sum = $value['info']->unitPrice * $value['quantity'];                         ?>
                                        <p class="cart_total_price">đ{{number_format($value['total'])}}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{url::to('/delcart/'.$value['info']->productID)}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?> 
            </tbody>
          </table>
        </div>
      </div>
    <?php endif ?>

@endsection