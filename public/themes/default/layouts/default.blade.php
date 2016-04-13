<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html" />
        <meta name="author" content="Lê Hùng - 0984504580" />
        <meta charset="UTF-8" />
        <title>{{$extra_data['title']}}</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin,vietnamese' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" type="text/css" href="{{$resources_path}}/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="{{$resources_path}}/css/style.css" />
        <script type="text/javascript" src="{{$resources_path}}/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="{{$resources_path}}/js/bootstrap.min.js"></script>
        <script src="{{$resources_path}}/js/owl-carousel/owl.carousel.js"></script>
        <link rel="stylesheet" href="{{$resources_path}}/js/owl-carousel/owl.carousel.css"/>
        <script type="text/javascript" src="{{$resources_path}}/js/common.js"></script>
        {{-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9acc6166fb3e21" async="async"></script> --}}
    </head>
    <body>
        <!-- BEGIN: HEADER -->
        <header>
            <div class="banner">
                <div class="container">
                    <div class="logo col-md-2">
                        <a href="/" title="Trang chủ"><img src="{{$resources_path}}/img/logo.png" alt="Logo" /></a>
                    </div>
                    <div class="logo-txt col-md-8">
                        <img src="{{$resources_path}}/img/logo-txt.png" alt="Logo" />
                    </div>
                    <div class="text-right contact col-md-2">
                        <p class="phone"><i class="icon icon-phone"></i> (048) 582 8818</p>
                        <p class="email"><i class="icon icon-email"></i> <a href="mailto:contact@envina.vn">contact@envina.vn</a></p>
                    </div>
                </div>
            </div>
            {{isset($nav_main)?$nav_main:''}}
        </header>
        <!-- END: HEADER -->
        <div class="wrapper">
            <div class="breadcumb breadcrumbs">
            <div class="container">
                @if (isset($extra_data['breadcrumbs']))
                    @foreach ($extra_data['breadcrumbs'] as $crumb)
                    <a href="{{$crumb['link']}}">{{$crumb['title']}}</a> <span class="spacing"></span>
                    @endforeach
                @endif
            </div>
            </div>
            <!-- BEGIN: CONTENT -->
            <div class="container">
                <div class="col-lg-8 no-padding">
                    {{isset($content)?$content:''}}
                </div>
                <div class="col-lg-4 no-padding-left" id="sidebar">
                    {{isset($sidebar)?$sidebar:''}}
                </div>
            </div>
            <!-- END: CONTENT -->
        </div>
        <footer>
            {{isset($footer_link)?$footer_link:''}}
            <div class="footer-content">
                <div class="container">
                    {{isset($footer_content)?$footer_content:''}}
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container text-center">© 2015 <a href="/">envina.vn.</a> All Rights Reserved. Designed by <a href="http://iguru.vn">VietClever.</a></div>
            </div>
        </footer>
    </body>
</html>