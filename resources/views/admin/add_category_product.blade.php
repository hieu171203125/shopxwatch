@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form role="form" action="{{URL::to('/save_category_product')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" method>
                            <label for="exampleInputEmail1">ID danh mục</label>
                            <input type="text" name="categoryID" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group" method>
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="categoryName" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea type="password" style="resize: none;" rows="5" name="description" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục" required></textarea>
                        </div>

                        
                        <button type="submit" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection