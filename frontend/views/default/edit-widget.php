<?php

/* @var $this yii\web\View */

$this->title = '编辑';

use frontend\assets\AppAsset;
use yii\helpers\Url;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ijackua\lepture\Markdowneditor;
use ijackua\lepture\MarkdowneditorAssets;

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
MarkdowneditorAssets::register($this);
?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h1>Article to Edit By MarkDown </h1>
            <div class="archives-form" style="margin-top: 100px;">
                <?php $form = ActiveForm::begin(); ?>
                <?= Markdowneditor::widget([
                    'model' => $model,
                    'attribute' => 'content',
                    'leptureOptions' => [
                        'toolbar' => false
                    ]
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>


        </div>
    </div>
</div>
