<?php

/* @var $this yii\web\View */

$this->title = '查看';

use frontend\assets\AppAsset;
use yii\helpers\Url;
//use frontend\dao\MarkDowner;
use yii\helpers\Markdown;

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
//$markdown = new MarkDowner();
?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            echo Markdown::process($model->content, 'gfm');
//            echo $markdown->convertMarkdownToHtml($model->content);
            ?>
    </div>
</div>