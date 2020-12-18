@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
  <div class="panel-heading">
    Liệt kê danh mục sản phẩm
  </div>
  <div class="row w3-res-tb">

  </div>

  <div class="table-responsive">
    <?php 
    $message = Session::get('message');
    if($message)
    {
      echo '<script> alert("' .$message. '");</script>';
      Session::put('message',null);
    }
    ?> 
    
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>

          <th width="150px">Tên sản phẩm</th>
          <th>Giá sản phẩm</th>
          <th>Giảm giá</th>
          <th>Hình ảnh</th>       
          <th>Danh mục</th>   
          <th>Thương Hiệu</th>
          <th>Trạng thái</th>
          <th style="width:25px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all_product as $key => $pro): ?>     
          <tr>
            <td>{{$pro -> productName}}</td>
            <td>{{$pro -> unitPrice}}</td>
            <td>{{$pro -> discount}}</td>
            <td><img src="public/upload/products/{{trim($pro -> thumbnail)}}" style="height: 100px;width: 100px;"></td>
            <td>{{$pro -> categoryName}}</td>
            <td>{{$pro -> companyName}}</td>
            <td><span class="text-ellipsis">
              <?php 
              if ($pro->status ==0) {
                ?>
                <a href="{{URL::to('/active-product/'.$pro->productID)}}" >
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="8" r="8"/>
                  </svg>
                </a>
                <br>
                <label>Không hoạt động</label>
                <?php
              } else {
                ?>
                <a href="{{URL::to('/unactive-product/'.$pro->productID)}}" >
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15V1a7 7 0 1 1 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                  </svg></a>
                  <br>
                  <label>Hoạt động</label>
                  <?php
                }

                ?>

              </span></td>
              <td>
                <a href="{{URL::to('/edit-product/'.$pro->productID)}}" class="active" style="font-size: 20px" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>

                </a>
                <a href="{{URL::to('/delete-product/'.$pro->productID)}}" class="active" onClick="return confirm('Are you absolutely sure you want to delete?')" style="font-size: 20px" ui-toggle-class="">

                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      {!! $all_product->links() !!}
    </footer>
  </div>
</div>
@endsection