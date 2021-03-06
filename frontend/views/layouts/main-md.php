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
<div class="navbar navbar-inverse" style="margin-top: -30px">
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
                <li class="reddot"><a href="<?= Url::to(['default/tag']) ?>">归档</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li><a href="<?= Url::to(['site/login']) ?>" target="_blank">登录</a></li>
                <?php else: ?>
                    <li><a href="<?= Url::to(['site/logout']) ?>">退出</a></li>
                    <?php if (Yii::$app->getUser()->identity->email == 'maoxingpei8686@163.com') :?>
                        <li><a href="<?= Url::to(['home/edit-md']) ?>" target="_blank"><i class="fa fa-edit">MarkDown</i></a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <form class="navbar-form navbar-right" action="<?= Url::to(['default/list']) ?>" method="get">
                <div class="input-group">
                    <input type="search" name="keyword" value="" class="input-search form-control" placeholder="搜索文章">
                    <input type="hidden" name="type" value="search">
                    <a class="clear"></a>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="bc-social" style="margin-top: -17px;">
    <div class="container">
        <ul class="bc-social-buttons">
            <li class="social-forum">
                <a class="" href="https://github.com/Maoxp" title="Bootstrap问答社区" target="_blank">
                    <i class="fa fa-github"> github</i>
                </a>
            </li>
            <li class="social-weibo">
                <a href="https://weibo.com/bootcss" title="Bootstrap中文网官方微博" target="_blank"><i
                            class="fa fa-weibo"></i> 广告引流入口</a>
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
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>