@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
  <div class="panel-heading">
    Liệt kê danh mục sản phẩm
  </div>
  <div class="row w3-res-tb">
    {{-- <div class="col-sm-3">
      <div class="input-group">
        <input type="text" class="input-sm form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn btn-sm btn-default" type="button">Go!</button>
        </span>
      </div>
    </div> --}}
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

          <th>ID</th>
          <th>Tên danh mục</th>
          <th>Mô tả</th>
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all_category_product as $key => $cate_pro): ?>     
          <tr>

            <td>{{$cate_pro -> categoryID}}</td>
            <td>{{$cate_pro -> categoryName}}</td>
            <td>{{$cate_pro -> description}}</td>
            <td><span class="text-ellipsis">  
            </span></td>
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->categoryID)}}" class="active" style="font-size: 20px" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
                
              </a>
              <a href="{{URL::to('/delete-category-product/'.$cate_pro->categoryID)}}" class="active" onClick="return confirm('Are you absolutely sure you want to delete?')" style="font-size: 20px" ui-toggle-class="">

                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <footer class="panel-footer">
    <div class="row">
      {!! $all_category_product->links() !!}
      
    </div>
  </footer>
</div>
</div>
@endsection