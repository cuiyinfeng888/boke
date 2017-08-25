<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="keywords" content="Neo Blog Theme, Free HTML CSS Template, 2 column, header artwork" />
    <meta name="description" content="Neo Blog Theme - Free HTML CSS Template brought to you by templatemo.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=0.5,user-scalable=yes">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link rel="shortcut icon" href="/images/qwe.jpg" type="image/x-icon" />

    <link rel="stylesheet" href="/bs3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/s/jquery.js"></script>
    <script src="/js/jquery-latest.min.js"></script>
    <script src="/js/unslider.js"></script>
    <script src="/bs3/js/bootstrap.min.js"></script>

</head>
<body>
    <div id='top_big_box' class="container">
       <div class="row">
           <div id='site_name_box' class="col-xs-12 col-md-12">
               CURD小码农
           </div>
             <nav class="col-xs-12 col-md-12">
                 <ul class="nav navbar-nav">
                     <li class="active navli"><a href="#">PHP杂谈</a></li>
                     <li class="navli"><a href="#">框架套路</a></li>
                     <li class="navli"><a href="#">Linux世界</a></li>
                     <li class="navli"><a href="#">开源产品</a></li>
                 </ul>
             </nav>
       </div>
    </div>
    <div id='index_below_nav_big_box' class="container">
         <div  class="row">
            <div id="index_below_nav_left" class="col-xs-12 col-md-9">
                <div class="banner">
                    <ul>
                        <li><img src="/images/ciyun.jpg" alt=""></li>
                        <li><img src="/images/qwe.jpg" alt=""></li>
                        <li><img src="/images/ciyun.jpg" alt=""></li>
                        <li><img src="/images/1.jpg" alt=""></li>
                    </ul>
                    <a href="javascript:;" readonly class="unslider-arrow prev"><</a>
                    <a href="javascript:;" readonly  class="unslider-arrow next">></a>
                </div>
                <div id="newest_quest">


                </div>

            </div>
             <div id="index_below_nav_right" class="col-xs-12 col-md-3">

             </div>
         </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>
<script>
    $(function(){
        var unslider = $('.banner').unslider({
            speed: 500,               //  The speed to animate each slide (in milliseconds)
            delay: 3000,              //  The delay between slide animations (in milliseconds)
            complete: function() {},  //  A function that gets called after every slide animation
            keys: true,               //  Enable keyboard (left, right) arrow shortcuts
            dots: true,               //  Display dot navigation
            fluid: false              //  Support responsive design. May break non-responsive designs
        });
        $('.unslider-arrow').click(function() {
            var fn = this.className.split(' ')[1];

            //  Either do unslider.data('unslider').next() or .prev() depending on the className
            unslider.data('unslider')[fn]();
        });
    })
</script>
