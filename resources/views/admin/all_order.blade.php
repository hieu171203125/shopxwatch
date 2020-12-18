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
          <th>Ngày đặt</th>
          <th>Trạng thái </th>
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all_order as $key => $value): ?>    
          <tr>
            <td><a href="{{URL::to('order_detail/'.$value->orderID)}}"> {{$value-> orderID}}</a></td>
            <td>{{$value -> orderDate}}</td>
            {{-- <td>{{$value -> status}}</td> --}}
            <td><span class="text-ellipsis">
                <?php 
                if ($value->status ==0) {
                  ?>
                  <a href="{{URL::to('/active_order/'.$value->orderID)}}" >
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="8" cy="8" r="8"/>
                    </svg>
                  </a>
                  <br>
                  <label>Chưa xác nhận</label>
                  <?php
                } else {
                  ?>
                  <a href="" >
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15V1a7 7 0 1 1 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                    </svg></a>
                    <br>
                    <label>Đã xác nhận</label>
                    <?php
                  }
  
                  ?>
  
                </span></td>
            <td>
  
              {{-- <a href="{{URL::to('/delete-order/'.$value->orderID)}}" class="active" onClick="return confirm('Are you absolutely sure you want to delete?')" style="font-size: 20px" ui-toggle-class="">

                <i class="fa fa-times text-danger text"></i>
              </a> --}}
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <footer class="panel-footer">
    <div class="row">
      {!! $all_order->links() !!}
    </div>
  </footer>
</div>
</div>
@endsection