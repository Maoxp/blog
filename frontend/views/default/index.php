<?php

/* @var $this yii\web\View */

$this->title = '首页';

use frontend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

if (isset($js_list)) {
    foreach ($js_list as $k => $href) {
        AppAsset::addScript($this, Url::home() . $href);
    }
}
if (isset($css_list)) {
    foreach ($css_list as $k => $href) {
        AppAsset::addCss($this, Url::home() . $href);
    }
}
?>
<style>
    .post-preview > a {
        /*color: #212529;*/
        transition: all .2s
        text-decoration: none;
        background-color: transparent;
    }
    .post-preview > .author-created{
        color: #b2bac2 !important; font-size:95%
    }
    .post-preview >.post-subtitle {
        font-weight: 300;
        margin: 0 0 10px;
    }

</style>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-xs-9 col-sm-9 col-lg-8 col-md-6">
            <?php foreach ($rows as $key => $row): ?>
                <div class="post-preview">
                    <a href="<?= Url::to(['default/detail', "id"=> $row['id']])?>" class="post-title">
                        <h3><?= $row['title']?></h3>
                    </a>
                    <p class="author-created"><?= date('Y-m-d', $row['created'])?>· 旭尧 </p>
                    <h4 class="post-subtitle"><?= $row['subtitle'] .'...'?></h4>
                    <span style="color: #777; margin-right: 1rem !important;"> <i class="fa fa-eye" aria-hidden="true"><?= $row['reads']; ?></i> </span>
                    <span style="color: #777; margin-right: 1rem !important;"> <i class="fa fa-comments" aria-hidden="true"> 0</i></span>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>

        <!--<div class="col-xs-3 col-sm-3 col-lg-4 col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
            </div>
        </div>-->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>About me</h4>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>
            <div class="sidebar-module">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                    <li><a href="#">March 2014</a></li>
                    <li><a href="#">February 2014</a></li>
                    <li><a href="#">January 2014</a></li>
                    <li><a href="#">December 2013</a></li>
                    <li><a href="#">November 2013</a></li>
                    <li><a href="#">October 2013</a></li>
                    <li><a href="#">September 2013</a></li>
                    <li><a href="#">August 2013</a></li>
                    <li><a href="#">July 2013</a></li>
                    <li><a href="#">June 2013</a></li>
                    <li><a href="#">May 2013</a></li>
                    <li><a href="#">April 2013</a></li>
                </ol>
            </div>
            <div class="sidebar-module">
                <h4>Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            显示第 <?= ($page-1)*$pageSize +1  ?> 至 <?= ($page-1) * $pageSize + count($rows) ?> 项结果，
            共 <?= $total  ?> 项
        </div>
        <?= $pagination ?>
    </div>

</div>