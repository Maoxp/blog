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
        .input-search {
            padding-left: 5px;
            border: 1px solid #ccc;
            width: 300px;
            height: 40px;
            line-height: 26px;
            background-color: #e5e5e5;
        }

        .input-submit {
            background-color: #333;
            color: #FFF;
            width: 50px;
            border: none;
            cursor: pointer;
            height: 40px;
            line-height: 28px;
            border-radius: 5px;
        }
    </style>
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
            <a class="navbar-brand hidden-sm" href="/">首页</a>
        </div>
        <div class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="reddot"><a href="<?= Url::to(['default/tag'])?>">归档</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li><a href="<?= Url::to(['site/login']) ?>" target="_blank">Login</a></li>
                <?php else: ?>
                    <li><a href="<?= Url::to(['site/logout']) ?>">Logout</a></li>
                    <?php if (Yii::$app->getUser()->identity->email == 'maoxingpei8686@163.com') :?>
                        <li><a href="<?= Url::to(['home/edit-md']) ?>"><i class="fa fa-edit">MarkDown</i></a></li>
                    <?php endif; ?>
                <?php endif; ?>
               <li style="left: 130px;">
                   <form action="<?= Url::to(['default/list'])?>" method="get">
                       <input type="search" name="keyword" class="input-search" value="" placeholder="你想搜啥...">
                       <input type="hidden" name="type" value="search">
                       <input type="submit" class="input-submit" value="搜索">
                   </form>
               </li>
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
                <a class="" href="https://github.com/Maoxp" title="github" target="_blank">
                    <i class="fa fa-github"> github</i>
                </a>
            </li>
            <li class="social-weibo">
                <a href="http://www.hm5988.com" title="夏溪花木市场官方网站" target="_blank"><i
                            class="fa fa-weixin"></i> 公司官网</a>
            </li>
        </ul>
    </div>
</div>

<section class="content">
    <?php
    $message = Yii::$app->session->getFlash('message');
    if (isset($message) && !empty($message)): ?>
        <div class="alert alert-<?= $message['type'] ?>">
            <a href="#" class="close" data-dismiss="alert">
                &times;
            </a>
            <h4>温馨提示</h4>
            <?= $message['msg'] ?>
        </div>
    <?php endif; ?>

    <?= $content ?>
</section>


<footer class="navbar-default footer ">
    <div class="container">
        <ul class="list-inline text-center">
            <li><a href="http://www.miibeian.gov.cn/" target="_blank">苏ICP备17018778号</a></li>
        </ul>

    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
