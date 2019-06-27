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
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php foreach ($rows as $key => $row): ?>
                <div class="post-preview">
                    <a href="<?= Url::to(['default/detail', "id"=> $row['id']])?>" class="post-title">
                        <h3><?= $row['title']?></h3>
                    </a>
                    <p class="author-created"><?= date('Y-m-d', $row['created'])?>· 旭尧 </p>
                    <h4 class="post-subtitle"><?= $row['subtitle'] .'...'?></h4>
                    <span style="color: #777; margin-right: 1rem !important;"> <i class="fa fa-eye" aria-hidden="true">1655</i> </span>
                    <span style="color: #777; margin-right: 1rem !important;"> <i class="fa fa-comments" aria-hidden="true">13</i></span>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>


        <div class="col-lg-4 col-md-2 mx-auto">

        </div>

    </div>
    <!-- Pager -->
    <div class="row">
         <div>
            显示第 <?= ($page-1)*$pageSize +1  ?> 至 <?= ($page-1) * $pageSize + count($rows) ?> 项结果，
            共 <?= $total  ?> 项
        </div>
        <?= $pagination ?>
    </div>

</div>