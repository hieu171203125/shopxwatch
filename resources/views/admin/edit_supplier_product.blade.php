@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa thương hiệu
            </header>
            <div class="panel-body">
                <?php 
            $message = Session::get('message');
            if($message)
            {
                echo '<script> alert("' .$message. '");</script>';
                Session::put('message',null);
            }
            ?> 
            <?php foreach ($edit_supplier_product as $key => $edit_value): ?>
                
            
                <div class="position-center">
                    
                    <form role="form" action="{{URL::to('/update-supplier/'.$edit_value->supplierID)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" method>
                            <label for="exampleInputEmail1">ID thương hiệu</label>
                            <input type="text" name="supplierID" class="form-control" id="exampleInputEmail1" value="{{$edit_value->supplierID}}"required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên thương hiệu</label>
                            <textarea type="text" style="resize: none;" rows="1" name="companyName" class="form-control" id="exampleInputPassword1" value="" required>{{$edit_value->companyName}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea type="password" style="resize: none;" rows="1" name="address" class="form-control" id="exampleInputPassword1" value="" required>{{$edit_value->address}}</textarea>   
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="number" style="resize: none;" rows="1" name="phone" class="form-control" id="exampleInputPassword1" value="{{$edit_value->phone}}" required >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Website</label>
                            <textarea type="password" style="resize: none;" rows="1" name="website" class="form-control" id="exampleInputPassword1" value="" required>{{$edit_value->website}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info"> Cập nhật Thương Hiệu</button>
                    </form>
                </div>
                <?php endforeach ?>

            </div>
        </section>

    </div>
</div>
@endsection