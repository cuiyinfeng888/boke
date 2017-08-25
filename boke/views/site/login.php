<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="/images/favicon.png">

    <title>崔银峰的个人博客-登录</title>

    <!--Core CSS -->
    <link href="/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/css/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="/https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        .registration{
            right:0px !important;
            left:40px !important;
        }
        .user-login-info{
            margin-bottom: 0px !important;
        }
        #notice{
            height:20px;
            line-height: 20px;
        }
        .right{
            color:green !important;
        }
        .error{
            color:red !important;
        }
    </style>
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">崔 银 峰 的 个 人 博 客</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" name="user" id='user' class="form-control" value="cyfwebadmin" placeholder="账号" autofocus>
                <input type="password"  name='password' id="pwd" class="form-control" value="cyfweb19900329" placeholder="密码">
                <div style="overflow: hidden">
                    <input type="text"  name='captcha' id="captcha" class="form-control"  style="width: 50%;float:left"" placeholder="验证码">
                    <img src="<?=Url::to('/site/captcha')?>" id="captcha_pic" alt="验证码"  style="margin-left:10%;margin-bottom:15px;width:40%;float:left;height:40px;cursor: pointer">
                </div>
                <div>
                    <input type="checkbox" name ='remember'  value="remember-me">记住密码
                </div>

            </div>
            <div id="notice">
               <p style="display:none"> 登录成功;页面跳转中……</p>
            </div>
            <button class="btn btn-lg btn-login btn-block" type="button">立即登录</button>

        </div>
      </form>

    </div>
    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="/js/jquery.js"></script>
    <script src="/bs3/js/bootstrap.min.js"></script>

  </body>
</html>
<script>
$(function(){
    $('#captcha_pic').click(function(){
        $(this).attr('src','/site/captcha?'+Math.random(0,1))
    })
    function nametest(){
        var name = $.trim($('#user').val());
        if(name==''){
            alert('用户名不能为空！！');
            return false;
        }else{
            return true;
        }
    }

    function  pwdtest(){
        var pwd = $.trim($('#pwd').val());
        if(pwd==''){
            alert('请输入密码！！');
            return false;
        }else{
            return true;
        }
    }
    function codetest(){
        var code = $.trim($('#captcha').val());
        if(code==''){
            alert('验证码不能为空！！');
            return false;
        }else{
            return true;
        }
    }
    $('.btn-login').click(function(){
        if(nametest()&&pwdtest()&&codetest()){
            var form = $('.form-signin').serialize();
            $.ajax({
                url:'<?php echo Url::toRoute("/site/ajaxlogin") ?>',
                type:'post',
                data:form,
                dataType:'json',
                success:function(data){
                   if(!data.code){
                        $('#notice p').html(data.msg).removeClass('error').addClass('right').show();
                       setTimeout(function(){
                          location.href ='<?php echo Url::toRoute('/site/index')?>'
                       },2000);
                   }else{
                       $('#notice p').html(data.msg).removeClass('right').addClass('error').show();
                       setTimeout(function(){
                           $('#notice p').fadeOut(2000);
                       },2000);
                       $('#captcha_pic').click();
                   }
                }
            })
        }

    })
})
</script>
