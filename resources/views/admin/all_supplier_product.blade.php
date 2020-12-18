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

          <th>ID </th>
          <th>Tên </th>
          <th>Địa chỉ </th>
          <th>Điện thoại </th>
          <th>Website</th>
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all_supplier_product as $key => $supp_value): ?>    
          <tr>
            <td>{{$supp_value -> supplierID}}</td>
            <td>{{$supp_value -> companyName}}</td>
            <td>{{$supp_value -> address}}</td>
            <td>{{$supp_value -> phone}}</td>
            <td>{{$supp_value -> website}}</td>
            <td>
              <a href="{{URL::to('/edit-supplier/'.$supp_value->supplierID)}}" class="active" style="font-size: 20px" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
                
              </a>
              <a href="{{URL::to('/delete-supplier/'.$supp_value->supplierID)}}" class="active" onClick="return confirm('Are you absolutely sure you want to delete?')" style="font-size: 20px" ui-toggle-class="">

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
      {!! $all_supplier_product->links() !!}
    </div>
  </footer>
</div>
</div>
@endsection