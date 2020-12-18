@extends('layout')
@section('content')
{{-- <link rel="stylesheet" href="../resources/sass/app.scss"> --}}
<link rel="stylesheet" href="../resources/sass/styledetail.css">
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<?php foreach ($img as $key => $value1): ?>		

			<div id="similar-product" class="carousel slide" data-ride="carousel">
				<?php $getimg = trim($value1->image) ;
				$img = (explode(';', $getimg)) ;
				?>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php foreach ($img as $key => $value): ?>
						<?php if (strlen($value)>0): ?>
							<div class="item <?php echo $key==0?' active':"" ?>">
								<a href=""><img  class="subImg"  src="{{URL::to('public/upload/products/'.trim($value)) }}" alt=""></a>	
							</div>
						<?php endif ?>
					<?php endforeach ?>

				</div>

				<!-- Controls -->
				<a class="left item-control" href="#similar-product" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="right item-control" href="#similar-product" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		<?php endforeach ?>

	</div>
	<div class="col-sm-7">
		<?php foreach ($product as $key => $value): ?>
			<div class="product-information"><!--/product-information-->
				<form action="{{URL::to('/addcart/'.$value->productID)}}" method="post">
					{{ csrf_field() }}
					<img src="images/product-details/new.jpg" class="newarrival" alt="" />
					<h2 class="product_name" >{{$value->productName}}</h2>
					<hr>
					<span>
						<div class="price">
							<div class="unitPrice" <?php echo (double)$value->discount>0?'':'hidden' ?>>
								<i><s>₫ {{number_format($value->unitPrice)}}</s></i>
							</div>

							<div class="discountPrice">
								₫ {{number_format((1-0.01*(double)$value->discount)*$value->unitPrice )}} 
								<i class="discount" <?php echo  (double)$value->discount>0?'':'hidden' ?>>{{"(-".$value->discount."%)"}} </i>
							</div>

							{{-- <div class=""><b>Quantity:</b> --}}
								<input type="number" name="quantity" value="1" min="1" hidden class="quantity"/>
							{{-- </div> --}}
						</span>
						<div class="availability" ><b>Availability:
						</b>
						
						<?php
						echo $value->quantity >0?"<b style='color: cyan'>In Stock</b> ":"<b style='color: red'>Out Stock</b>";  
						?>
					</div>
					<div><b>Supplier:</b name="companyName"> {{$value->companyName}}</div>
						<div><b>Category:</b> {{$value->categoryName}}</div>
						<br>				
					</div><!--/product-information-->
					<!-- Button -->
					<div class="button">
						<!-- button Back -->
						<a href="{{URL::TO('/')}}" class="btn btn-info btnBack">
							<i class="fa fa-shopping-cart"></i>
							Back To Shopping
						</a>
						<!-- button Add to cart -->
						<button type="submit" class="btn btn-success  btnAddToCart" >
							<i class="fa fa-shopping-cart"></i>Add to cart
						</button>
					</div>
				</form>
				<!-- /Button -->
			<?php endforeach ?>
		</div>
	</div><!--/product-details-->
	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12 ">
			<ul class="nav nav-tabs">
				<li class="active" ><a href="#details" data-toggle="tab">Details</a></li>
				<li  ><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>						
			</ul>
		</div>
		<?php foreach ($product as $key => $value): ?>
			<div class="tab-content">
				<!-- tab: detail -->
				<div class="tab-pane fade active in" id="details" >
					<p class="description"> {{$value->description}}</p>
				</div>
				<!-- tab: copanyprofile -->
				<div class="tab-pane fade " id="companyprofile" >
					<p>
						<a>Catrgory: {{$value->categoryName}}</a><br>
						<a >Supplier : {{$value->companyName}}</a><br>
						<a >Address: {{$value->supAdd}}</a><br>
						<a >Website : {{$value->supWeb}}</a><br>
						<a >Phone : {{$value->supPhone}}</a>

					</p>

				</div>											
			</div>
		<?php endforeach ?>
	</div><!--/category-tab-->
	@endsection