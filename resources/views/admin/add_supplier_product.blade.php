@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Basic Forms
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
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save_supplier')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" method>
                            <label for="exampleInputEmail1">ID thương hiệu</label>
                            <input type="text" name="supplierID" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục"required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên thương hiệu</label>
                            <textarea type="password" style="resize: none;" rows="1" name="companyName" class="form-control" id="exampleInputPassword1" placeholder="Tên thương hiệu"required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea type="password" style="resize: none;" rows="1" name="address" class="form-control" id="exampleInputPassword1" placeholder="Địa chỉ"required></textarea>   
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="number"   style="resize: none;" rows="1" name="phone" class="form-control" id="exampleInputPassword1" placeholder="Phone Number"required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Website</label>
                            <textarea type="password" style="resize: none;" rows="1" name="website" class="form-control" id="exampleInputPassword1" placeholder="Website"required></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm Thương Hiệu</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection