<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);
$username = Yii::$app->user->identity->username;
$ctrlId = Yii::$app->controller->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('崔银峰的个人博客') ?></title>
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="/images/symbol.jpg">
    <!--Core CSS -->
    <link href="/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/css/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--responsive table-->
    <link href="/css/table-responsive.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>-->
    <![endif]-->
    <script src="/js/jquery.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<section id="container" >
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand brand-bg">
            <a href="" class="logo back-logo">
                崔银峰
            </a>
            <div class="sidebar-toggle-box circle-bg">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->


        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <?php if($username){?>
                    <li class="dropdown exit">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <span class="username">您好,<?=$username?></span>

                        </a>
                    </li>
                    <!-- user login dropdown end -->
                    <li class="exit">
                        <a href="<?=Url::toRoute('/site/logout')?>">退出</a>
                    </li>
                <?php }?>
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <aside>
        <div id="sidebar" class="nav-collapse side-list">
            <!-- sidebar menu start-->            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="li-hover <?= $ctrlId=='category'?'active':'';?>" href="<?= Url::toRoute('/category/index')?>">
                            <i class="glyphicon glyphicon-th"></i>
                            <span>分类管理</span>
                        </a>
                    </li>
                    <li>
                        <a class="li-hover <?= $ctrlId=='quest'?'active':'';?>" href="<?= Url::toRoute('/quest/index')?>">
                            <i class="fa fa-bar-chart-o font-a"></i>
                            <span>文章管理</span>
                        </a>
                    </li>
                </ul></div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <?= $content ?>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->

</section>



<footer class="footer">
    <div class="container">
        <p class="pull-left">崔银峰的个人博客</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
<script src="/js/jquery.nicescroll.js"></script>
<script src="/bs3/js/bootstrap.min.js"></script>
<!--common script init for all pages-->
<script src="/js/scripts.js"></script>
</html>
<?php $this->endPage() ?>
