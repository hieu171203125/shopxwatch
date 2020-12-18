@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa danh mục
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
            <?php foreach ($edit_category_product as $key => $edit_value): ?>
                
            
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->categoryID)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" method>
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="categoryID" value="{{$edit_value->categoryID}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục"required>
                        </div>

                        <div class="form-group" method>
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="categoryName" value="{{$edit_value->categoryName}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục"required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea type="password" style="resize: none;" rows="5" name="description" value="{{$edit_value->description}}" class="form-control" id="exampleInputPassword1" required>{{$edit_value->description}}</textarea>
                        </div>
                        
                        <button type="submit" name="update-category-product" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
                <?php endforeach ?>

            </div>
        </section>

    </div>
</div>
@endsection