<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>Express News a Entertainment Category Flat Bootstarp responsive Website Template | Home :: w3layouts</title>

    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Express News Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

    <!-- Custom Theme files -->
    <link href="{{ asset('css/style.css')}} " rel="stylesheet" type="text/css" media="all" />

</head>
<body>
@include('partials.header')

    <!-- header-section-ends-here -->
    <div class="wrap">
        <div class="move-text">
            <div class="breaking_news">
                <h2>Breaking News</h2>
            </div>
            <div class="marquee">
                <div class="marquee1"><a class="breaking" href="single.html">>>The standard chunk of Lorem Ipsum used since the 1500s is reproduced..</a></div>
                <div class="marquee2"><a class="breaking" href="single.html">>>At vero eos et accusamus et iusto qui blanditiis praesentium voluptatum deleniti atque..</a></div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="wrap">
            <div class="col-md-8 content-left">


                @yield('content')


            </div>
            <div class="col-md-4 side-bar">
                <div class="first_half">
                    <div class="newsletter">
                        <h1 class="side-title-head">Newsletter</h1>
                        <p class="sign">Sign up to receive our free newsletters!</p>
                        <form>
                            <input type="text" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}">
                            <input type="submit" value="submit">
                        </form>
                    </div>

                    @include('partials.popular')


                    <div class="side-bar-articles">
                        <div class="side-bar-article">
                            <a href="single.html"><img src="{{ asset('assets/sai.jpg') }}" alt="" /></a>
                            <div class="side-bar-article-title">
                                <a href="single.html">Contrary to popular belief, Lorem Ipsum is not simply random text</a>
                            </div>
                        </div>
                        <div class="side-bar-article">
                            <a href="single.html"><img src="{{ asset('assets/sai2.jpg') }}" alt="" /></a>
                            <div class="side-bar-article-title">
                                <a href="single.html">There are many variations of passages of Lorem</a>
                            </div>
                        </div>
                        <div class="side-bar-article">
                            <a href="single.html"><img src="{{ asset('assets/sai3.jpg') }}" alt="" /></a>
                            <div class="side-bar-article-title">
                                <a href="single.html">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="secound_half">
                    @include('partials.tag')

                    @include('partials.popular-news')
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- content-section-ends-here -->


@include('partials.footer')

    <a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <!---->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>


    <script type="text/javascript">
$(document).ready(function() {
/*
            var defaults = {
            wrapID: 'toTop', // fading element id
            wrapHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
            */
$().UItoTop({ easingType: 'easeOutQuart' });
});
    </script>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- for bootstrap working -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- //for bootstrap working -->
    <!-- web-fonts -->

    <script src="{{ asset('js/responsiveslides.min.js') }}"></script>
    <script>
$(function () {
    $("#slider").responsiveSlides({
        auto: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        pager: true,
    });
});
    </script>
    <script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
    <!--/script-->
    <script type="text/javascript">
jQuery(document).ready(function($) {
    $(".scroll").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
    });
});
    </script>

    <!-- search-scripts -->
    <script src="{{ asset('js/classie.js') }}"></script>
    <script src="{{ asset('js/uisearch.js') }}"></script>
    <script>
new UISearch( document.getElementById( 'sb-search' ) );
    </script>
    <!-- //search-scripts -->

    <script type="text/javascript" src="{{ asset('js/jquery.marquee.min.js') }}"></script>
    <script>
$('.marquee').marquee({ pauseOnHover: true });
//@ sourceURL=pen.js
    </script>

    <script type="text/javascript">

        $(function() {
            $('.has-dropdown').click(function() {
                $(this).children('ul').fadeToggle('fast');
            });
        });

    </script>

</body>
</html>
