<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .job-hot {
            position: absolute;
            color: #d9534f;
            right: 0;
            top: 15px;
        }
    </style>
    <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>
<!-- Navigation -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-sm" href="http://www.bootcss.com">Bootstrap中文网</a>
        </div>
        <div class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="hidden-sm hidden-md"><a href="https://v2.bootcss.com/" target="_blank">Bootstrap2中文文档</a>
                </li>
                <li><a href="https://v3.bootcss.com/" target="_blank">Bootstrap3中文文档</a></li>
                <li><a href="https://v4.bootcss.com/" target="_blank">Bootstrap4中文文档</a></li>
                <li><a href="/p/lesscss/" target="_blank">Less 教程</a></li>
                <li><a href="https://www.jquery123.com/" target="_blank">jQuery API</a></li>
                <li><a class="reddot" href="http://www.youzhan.org/" target="_blank">网站实例</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li><a href="<?= Url::to(['site/login']) ?>" target="_blank">Login</a></li>
                <?php else: ?>
                    <li><a href="<?= Url::to(['site/logout']) ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header -->

<style>
    .overlay {
        position: absolute; top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: #212529;
        opacity: .5;
    }
</style>
<div class="jumbotron masthead" style="background-image: url(<?= Url::home() . 'img/home-bg.jpg' ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <h1>Clean Blog</h1>
            <p>海阔凭鱼跃，天高任鸟飞</p>
            <ul class="masthead-links">
                <li>
                    <span>海阔凭鱼跃，天高任鸟飞</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="bc-social">
    <div class="container">
        <ul class="bc-social-buttons">
            <li class="social-forum">
                <a class="" href="http://wenda.bootcss.com" title="Bootstrap问答社区" target="_blank">
                    <i class="fa fa-comments"></i>广告引流入口
                </a>
            </li>
            <li class="social-weibo">
                <a href="https://weibo.com/bootcss" title="Bootstrap中文网官方微博" target="_blank"><i
                            class="fa fa-weibo"></i> 广告引流入口</a>
            </li>
        </ul>
    </div>
</div>

<?= $content ?>

<footer class="footer ">
    <div class="container">
        <div class="row footer-top">
            <div class="col-md-6 col-lg-6">
                <h4>
                    <img src="https://cdn.jsdelivr.net/npm/@bootcss/www.bootcss.com@0.0.2/dist/img/logo.png">
                </h4>
                <p>我们一直致力于为广大开发者提供更多的优质技术文档和辅助开发工具！</p>
            </div>
            <div class="col-md-6  col-lg-5 col-lg-offset-1">
                <div class="row about">
                    <div class="col-sm-3">
                        <h4>关于</h4>
                        <ul class="list-unstyled">
                            <li><a href="/about/">关于我们</a></li>
                            <li><a href="/ad/">广告合作</a></li>
                            <li><a href="/links/">友情链接</a></li>
                            <li><a href="/hr/">招聘</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4>联系方式</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://weibo.com/bootcss" title="Bootstrap中文网官方微博" target="_blank">新浪微博</a>
                            </li>
                            <li><a href="mailto:admin@bootcss.com">电子邮件</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h4>旗下网站</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://www.golaravel.com/" target="_blank">Laravel中文网</a></li>
                            <li><a href="https://www.ghostchina.com/" target="_blank">Ghost中国</a></li>
                            <li><a href="https://www.bootcdn.cn/" target="_blank">BootCDN</a></li>
                            <li><a href="https://pkg.phpcomposer.com/" target="_blank">Packagist中国镜像</a></li>
                            <li><a href="https://www.return.net/" target="_blank">燃腾教育</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-2">
                        <h4>赞助商</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://www.maoyuncloud.com/" target="_blank">猫云</a></li>
                            <li><a href="https://www.jdcloud.com/" target="_blank">京东云</a></li>
                            <li><a href="https://www.upyun.com" target="_blank">又拍云</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <hr/>
        <div class="row footer-bottom">
            <ul class="list-inline text-center">
                <li><a href="http://www.miibeian.gov.cn/" target="_blank">京ICP备11008151号</a></li>
                <li>京公网安备11010802014853</li>
            </ul>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
