@yield('categoryLayout1')
<?php foreach ($data1['category'] as $key => $cate_value): ?>                                                                
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{URL::to('/show_category/'.$cate_value->categoryID)}}">{{$cate_value->categoryName}}</a></h4>
                </div>
            </div>
       <?php endforeach ?>  
