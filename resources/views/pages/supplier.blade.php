    @extends('layout')
    @section('content')
    <div class="features_items">
        
        <?php foreach ($name_supplier as $key => $value1): ?>
            <h2 class="title text-center">{{$value1->companyName}}</h2>
            <h3 class="text-center"> <?php echo count($all_product)==0?'This supplier is empty!':'';?></h3>
        <?php endforeach ?>

        <?php foreach ($all_product as $key => $value): ?>        
        <div class="col-sm-4 item">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo ">   
                     <?php $thumbnail = ltrim($value->thumbnail) ?>
                     <img class="item-image" src="{{URL::to('public/upload/products/'.$thumbnail)}}" alt="" />                     
                     <!-- <h2 class="item-price"><?php {{echo number_format($value->unitPrice) ;}} ?> đ</h2> -->
                    <img class="item-sale" <?php echo (double)$value->discount>0?'':'hidden' ?> src="{{URL::to('public\frontend\images\product\sale.png')}}" alt="" />
                    </div>
                     <div class="item-infor">
                         <div class="item-name">
                            <b><?php 
                                echo strlen($value->productName)>35?substr($value->productName,0,44).'...':$value->productName;?>
                         </div></b>
                     <div class="unitPrice"  <?php echo (double)$value->discount>0?'':'hidden' ?>>
                                <i><s>₫ {{number_format($value->unitPrice)}}</s></i>
                            </div>
                    <div class="discountPrice">
                                ₫ {{number_format((1-0.01*(double)($value->discount>0?$value->discount:0))*$value->unitPrice )}} 
                                <i class="discount" <?php echo (double)$value->discount>0?'':'hidden' ?>> (-{{$value->discount}}%) </i>
                            </div>
                    </div>
                     
                 
            </div>
            <div class="choose">
                <div class="overlay-content">                                             
                    <a href="{{URL::to('/detail/'.$value->productID)}}" class="btn btn-default add-to-cart"><i class="fa fa-view"></i>View</a>
                                                            
                    <a href="{{URL::to('/addcart-home/'.$value->productID)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                
                    <img src="{{URL::to('public\frontend\images\logo\Xwatch_Logo2.jpg')}}">
                </div>
                
            </div>
        </div>
    </div>
        <?php endforeach ?>
    </div><!--features_items-->
    <div style="clear:both;">
        {!! $all_product->links(); !!}
        </div >
    @endsection
