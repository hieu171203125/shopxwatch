    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>X-Watch</title>
        <link href="{{asset('public/frontend/thaydoi.css')}}" > 
        <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->     
    <link rel="shortcut icon" href="{{('public/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{('images/ico/apple-touch-icon-57-precomposed.png')}}">
    <script src="resources/js/app.js" ></script>
</head><!--/head-->
<style type="text/css"></style>
<body>
    <?php 
            $message = Session::get('message');
            if($message)
            {
                echo '<script> alert("' .$message. '");</script>';
                Session::put('message',null);
            }
            ?>
    <header id="header"><!--header-->
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-1"><a href="{{URL::to('/')}}" class="active">
                        <img id="logo" src="{{asset('public/frontend/images/logo/Xwatch_Logo.png')}}" alt="XWatch">
                     </a>
                    </div>
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                
                                <li><a href="{{URL::TO('/order')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{URL::TO('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <?php if (Session::has('customer')): ?>
                                    <li><a href="#"><i class="fa fa-user"></i> {{Session::get('customer')->fullName}}</a></li>
                                    <li><a href="{{URL::TO('/logoutcus')}}"><i class="fa fa-lock"></i> Logout</a></li>
                                    <?php else: ?>
                                        <li><a href="{{URL::TO('/logincus')}}"><i class="fa fa-lock"></i> Login</a></li>
                                    <?php endif ?>     
                            </ul>
                        </div>

                    </div>
                    {{-- <div class="col-sm-5">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                {{-- <li><a href="{{URL::TO('/order')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{URL::TO('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <php if (Session::has('customer')): ?>
                                    <li><a href="#"><i class="fa fa-user"></i> {{Session::get('customer')->fullName}}</a></li>
                                    <li><a href="{{URL::TO('/logoutcus')}}"><i class="fa fa-lock"></i> Logout</a></li>
                                    <php else: ?>
                                        <li><a href="{{URL::TO('/logincus')}}"><i class="fa fa-lock"></i> Login</a></li>
                                    <php endif ?> 
                                </ul>
                            </div>
                        </div>   --}}
                       
                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <input type="text" id='searchStr'  value="<?php if(isset($searchStr)){ echo $searchStr ;}?>"  placeholder="Search">
                                <a href="" id="link-search"><button style="margin-top:0;color:#666" class="btn btn-primary btn-sm" >Search</button><a>
                                {{-- <form action="{{URL::TO('/search_PR')}}" method="POST">
                                    {{ csrf_field() }}
                                <input type="text" placeholder="Search" value="<?php if(isset($searchStr)){ echo $searchStr ;}?>" name="search"  id="seach" />
                                    <button type="submit" style="margin-top:0;color:#666" class="btn btn-primary btn-sm" >Search</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->

        <section id="slider"><!--slider-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#slider-carousel" data-slide-to="1"></li>
                                <li data-target="#slider-carousel" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="{{asset('public/frontend/images/banner/banner.jpg')}}" class="girl img-responsive" alt="" />                                                            
                                </div>
                                <div class="item">
                                    <img src="{{asset('public/frontend/images/banner/banner2.jpg')}}" class="girl img-responsive" alt="" />                                    
                                </div>                          
                                <div class="item">

                                    <img src="{{asset('public/frontend/images/banner/banner3.jpg')}}" class="girl img-responsive" alt="" />                                    
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2 class="testside">Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->                                 
                            <?php foreach ($cate_product as $key => $cate_value): ?>                                                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="{{URL::to('/show_category/'.$cate_value->categoryID)}}">{{$cate_value->categoryName}}</a></h4>
                                    </div>
                                </div>
                            <?php endforeach ?>      
                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2 class="testside">Supplier</h2>
                            <div class="brands-name">
                                <?php foreach ($supplier as $key => $supp_value): ?>       
                                    <ul class="nav nav-pills nav-stacked">                                   
                                        <li><a href="{{URL::to('/show_supplier/'.$supp_value->supplierID)}}"> <span class="pull-right"></span>{{$supp_value->companyName}}</a></li>
                                    </ul>
                                <?php endforeach ?>      
                            </div>
                        </div><!--/brands_products-->                                               


                    </div>
                </div>
                <!-- Main content -->
                <div class="col-sm-9 padding-right">
                  @yield('content')            
              </div>
              
             
          </div>
      </div>
 
  </section>
  <footer id="footer"><!--Footer-->
    <div class="footer-top">

    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">

                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About X-Watch</h2>
                        
                        <Address>Address: 3 Cau Giay, Ha Noi</Address>
                        <div>Phone: +8412345678</div>
                        <div>Email: nguyenvanhieu@gmail.com</div>
                        {{-- <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            
                        </form> --}}
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>X</span>-Watch</h2>

                    </div>
                </div>
                <div class="col-sm-6" style="border: 1px red;"> 
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.113227000563!2d105.80119047141133!3d21.0281550431831!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab424a50fff9%3A0xbe3a7f3670c0a45f!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBHaWFvIHRow7RuZyBW4bqtbiB04bqjaSAoVVRDKQ!5e0!3m2!1svi!2s!4v1604457153989!5m2!1svi!2s"
                     width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">

    </footer><!--/Footer-->
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    

    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
              var name_cus = $('.username-cus').val();
              var email_cus = $('.email-cus').val();
              var address_cus = $('.address-cus').val();
              var phone_cus = $('.phone-cus').val();
              var text_cus = $('.text-cus').val();
              var _token = $('input[name="_token"]').val();
              $.ajax({
                url: "{{url('/confirm-order')}}",
                method:'POST',
                data:{name_cus:name_cus,email_cus:email_cus,address_cus:address_cus,phone_cus:phone_cus,text_cus:text_cus,_token:_token},
                success:function(data2){
                   alert(data2);
               }

           });
          });
        });
    </script>
    <!-- Load Facebook SDK for JavaScript -->
    <!-- <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script> -->
    {{-- search --}}
    <script>
        $(document).ready(function(){
        $("#link-search").click(function(){    

            var link="http://localhost/BTL-CDCNPM/BTL-CDCNPM/search/"+document.getElementById("searchStr").value;
 //           var link="http://localhost:8080/BTLCNPM/CNPM/detail/PRO0015";
            $("#link-search").attr('href',link);
        });
        });
        </script>
    <!-- Your Chat Plugin code -->
    
</div>

</body>
</html>

