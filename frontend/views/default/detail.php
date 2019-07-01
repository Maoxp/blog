<?php

/* @var $this yii\web\View */

$this->title = '查看';

use frontend\assets\AppAsset;
use yii\helpers\Url;
use frontend\service\MarkDowner;

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
$markdown = new MarkDowner();
?>
<!-- Main Content -->
<div class="container">
    <h1 style="font-weight: 600"><?= $model->title?></h1>
    <?php if (!Yii::$app->getUser()->isGuest):?>
    <div>
        <a href="<?= Url::to(['home/edit-md', 'id' => $model->id])?>" role="button"  class="btn btn-success"> <i class="fa fa-edit"></i>在线修改</a>
    </div>
    <?php endif; ?>
    <ul class="list-inline dot-divider post-meta">
        <li class="list-inline-item text-small text-muted">
           2019-06-27
        </li>
        <li class="list-inline-item text-small text-muted">7205 字
        </li>
        <li class="list-inline-item text-small text-muted">
            1678 阅读
        </li>
        <li class="list-inline-item text-small text-muted">
            13 评论
        </li>
    </ul>
    <div class="row" style=" font-size: 15px !important;">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div id="markdown">
                <?php
                echo $markdown->convertMarkdownToHtml($model->content);
                ?>
            </div>
        </div>
    </div>
    <div class="row" style="font-size: 15px !important; margin-top: 15px;">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php if (!empty($front_model)): ?>
                <a href="<?= Url::to(['default/detail', 'id' => $front_model->id])?>">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                    <?= $front_model->title?>
                </a>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-6">
            <?php if (!empty($back_model)): ?>
                <a href="<?= Url::to(['default/detail', 'id' => $back_model->id])?>">
                    <?= $back_model->title?>
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
$js = <<<js
$(function() {
    $("#markdown table").addClass("table table-bordered table-hover table-condensed");
});
js;

$this->registerJs($js);
?>


