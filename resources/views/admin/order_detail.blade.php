@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin đăng nhập
    </div>
    
    <div class="table-responsive">
    <?php
          $message = Session::get('message');
          if($message){
            echo '<script> alert("' .$message. '");</script>';
              Session::put('message',null);
          }
          ?>
      <table class="table table-striped b-t b-light">
        <div class="panel-heading">
          Thông tin khách hàng
        </div>
        <thead>
          <tr>
           
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$customer->fullName}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->email}}</td>
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>

<br><br>

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
   
    <div class="table-responsive">
    <?php
          $message = Session::get('message');
          if($message){
            echo '<script> alert("' .$message. '");</script>';
              Session::put('message',null);
          }
          ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              Mã sản phẩm
            </th>
          <th>Tên sản phẩm</th>
          <th>Giá sản phẩm</th>
          <th>Giảm giá</th>
          <th>Số lượng</th>
          <th>Giá đã giảm</th>
          <th>Tổng tiền</th>
            
          <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i = 0;
          $total = 0;
          $subtotal=0;
          ?>
        @foreach($order_details as $key => $details)

          <?php
          $pr=[];
          foreach ($products as $k => $v) {
            # code...
            if($v->productID==$details->productID)
            {
              $pr=$v;
            }
          } 
          $i++;
          $subtotal = $details->quantity*(1-0.01*(double)$details->discount)*$details->unitPrice;
          $total+=$subtotal;
          ?>
          <tr>
           
            <td><i>{{$pr->productID}}</i></td>
            <td>{{$pr->productName}}</td>
            <td>{{number_format($details->unitPrice ,0,',','.')}}đ</td>
            <td>{{$details->discount}}</td>
            <td>{{$details->quantity}}</td>
            <td>{{(1-0.01*(double)$details->discount)*$details->unitPrice}}</td>
            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
          </tr>
        @endforeach
        <tr>
          <td>Tổng:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>{{number_format($total ,0,',','.')}}đ</td>
        </tr>
        </tbody>
      </table>

      <?php 
        if ($order->status ==0) {
          ?>
          <label>Chưa xác nhận</label>
          <br>
          <a href="{{URL::to('/active_order/'.$order->orderID)}}" >
            Xác nhận đơn hàng
          </a>
          <br>
          
          <?php
        } else {
          ?>
            <br>
            <label>Đã xác nhận</label>
            <?php
          }

          ?>
      
    </div>
   
  </div>
</div>
@endsection