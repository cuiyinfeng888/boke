<?php
require_once Yii::$app->basePath.'/web/jssdk.php';
$jssdk = new JSSDK(Yii::$app->params['appid'],Yii::$app->params['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=0.5,user-scalable=yes">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link rel="shortcut icon" href="/images/qwe.jpg" type="image/x-icon" />
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

</head>
<body>
   哈哈哈哈
</body>
</html>
<script>
    wx.config({
        debug: true,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone'
        ]
    });
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '赵伟很帅', // 分享标题
            link: 'www.cyfweb.cn/wx/share', // 分享链接
            imgUrl: 'http://www.cyfweb.cn/images/ds.jpg', // 分享图标
            success: function () {
               alert('分享成功');
            },
            cancel: function () {
                alert('你取消了分享，我不开心');// 用户取消分享后执行的回调函数
            }
        });

        wx.onMenuShareAppMessage({
            title: '赵伟很帅', // 分享标题
            desc: '赵伟是世界上最帅的男孩', // 分享描述
            link: 'www.cyfweb.cn/wx/share', // 分享链接
            imgUrl: 'http://www.cyfweb.cn/images/ds.jpg', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                alert('分享成功');// 用户确认分享后执行的回调函数
            },
            cancel: function () {
                alert('你取消了分享，我不开心');// 用户取消分享后执行的回调函数
            }
        });

        wx.onMenuShareQQ({
            title: '赵伟很帅', // 分享标题
            link: 'www.cyfweb.cn/wx/share', // 分享链接
            imgUrl: 'http://www.cyfweb.cn/images/ds.jpg', // 分享图标
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
                alert('你取消了分享，我不开心');// 用户取消分享后执行的回调函数
            }
        });

        wx.onMenuShareQZone({
            title: '赵伟很帅', // 分享标题
            link: 'www.cyfweb.cn/wx/share', // 分享链接
            imgUrl: 'http://www.cyfweb.cn/images/ds.jpg', // 分享图标
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
                alert('你取消了分享，我不开心');// 用户取消分享后执行的回调函数
            }
        });
    });
</script>