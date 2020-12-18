@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phảm
            </header>
            <div class="row w3-res-tb">
              
            </div>
            <div class="panel-body">
                <?php 
                $message = Session::get('message');
                if($message)
                {
                    echo '<script> alert("' .$message. '");</script>';
                    Session::put('message',null);
                }
                ?> 
                <?php foreach ($edit_product as $key => $value): ?>


                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-product/'.$value->productID)}}" method="post" 
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="productName" value="{{$value->productName}}" class="form-control" id="exampleInputEmail1" required>
                            </div>
                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Mã Sản Phẩm</label>
                                <input type="text" name="productID" value="{{$value->productID}}"class="form-control" id="exampleInputEmail1" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="categoryID" class="form-control input-sm m-bot15">                                
                                    <?php foreach ($cate_product as $key => $cate_value): ?>
                                        @if($cate_value->categoryID == $value->categoryID)
                                        <option  selected value="{{$cate_value->categoryID}}">{{$cate_value->categoryName}}</option>
                                        @else
                                        <option  value="{{$cate_value->categoryID}}">{{$cate_value->categoryName}}</option>
                                        @endif
                                    <?php endforeach ?>


                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu</label>
                                <select name="supplierID" class="form-control input-sm m-bot15">
                                    <?php foreach ($sup_product as $key => $sup_value): ?>
                                        @if($sup_value->supplierID == $value->supplierID)
                                        <option  selected value="{{$sup_value->supplierID}}">{{$sup_value->companyName}}</optsssion>
                                        @else
                                        <option  value="{{$sup_value->supplierID}}">{{$sup_value->companyName}}</option>
                                        @endif

                                    <?php endforeach ?>                         
                                </select>
                            </div>
                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="number" name="quantity" value="{{$value->quantity}}" class="form-control" id="exampleInputEmail1" required>
                            </div>
                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="number" name="unitPrice" value="{{$value->unitPrice}}"class="form-control" id="exampleInputEmail1" required>
                            </div>
                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Giảm giá</label>
                                <input type="number" name="discount" value="{{$value->discount}}"class="form-control" id="    exampleInputEmail1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="status" class="form-control input-sm m-bot15">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">không hoạt động</option> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm </label>
                                <textarea type="text" style="resize: none;" rows="5" name="description"  class="form-control" id="exampleInputPassword1" required>{{$value->description}}</textarea>
                            </div>
                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="image[]" class="form-control" id="exampleInputEmail1"  multiple="">
                            </div>
                            <div class="form-group" method>
                                <label for="exampleInputEmail1">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control" id="exampleInputEmail1"  multiple="">
                            </div>

                            <input type="text" name="type" value="add" hidden="true">

                            
                            <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                    </div>
                <?php endforeach ?>
            </div>
        </section>

    </div>
</div>
@endsection