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


        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <style>
                .right-title {
                    padding: 0 15px;
                    background: #f4f4f4;
                    line-height: 2;
                }
                .list-unstyled {
                    padding-left: 30px;
                }
                .list-unstyled  li  {
                    padding-top: 10px;
                }
                .wx-img {
                    height:134px;
                    background-image: url(<?= Url::home().'img/wx.png'?>);
                    background-repeat: no-repeat;
                    background-position: 20% 10%;
                }
            </style>
            <div class="sidebar-module sidebar-module-inset" style="padding: 26px 0;">
                <h4 class="right-title">Become friend <i class="fa fa-weixin"></i><label>旭尧</label> </h4>
                <div style="padding: 0 40px">
                    <label class="label label-info">● 爱好比较杂，日记比较乱</label>
                    <label class="label label-info">● 专注web后端开发</label>
                </div>
                <p class="wx-img"></p>
            </div>
            <div class="sidebar-module" style="padding-bottom: 20px">
                <h4 class="right-title">Archives</h4>
                <ul class="list-unstyled">
                    <?php foreach ($article_date as $item): ?>
                    <li><a href="<?= Url::to(['default/list','type'=>'date', 'keyword' => $item['created']])?>"><?= $item['created'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="sidebar-module">
                <h4 class="right-title">友情链接</h4>
                <ul class="list-unstyled">
                    <li><a href="https://github.com/" target="_blank">GitHub</a></li>
                    <li><a href="https://www.bootcss.com/" target="_blank">Bootstrap中文网</a></li>
                    <li><a href="https://v3.bootcss.com/" target="_blank">Bootstrap3中文文档</a></li>
                    <li><a href="https://www.jquery123.com/" target="_blank">jQuery API</a></li>
                </ul>
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