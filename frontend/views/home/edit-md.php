<?php

/* @var $this yii\web\View */

$this->title = '编辑';

use frontend\assets\AppAsset;
use yii\helpers\Url;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
            <div style="margin-top: 100px;">
                <?php $form = ActiveForm::begin(); ?>
                <div class="form-group">
                    <label for="" class="control-label">标题</label>
                    <input type="text" class="form-control" name="title" value="<?= $keyword['title'] ?? ''?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">摘要</label>
                    <input type="text" class="form-control" name="subtitle" value="<?= $keyword['subtitle'] ?? ''?>">
                </div>
                <label for="" class="control-label">内容</label>
                <div class="form-group" id="editor">
                    <textarea style="display:none;" name="editor_markdown_code"><?= $keyword['content'] ?? ''?></textarea>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>




<?php
$js = <<<js
$(function() {
        var editor = editormd("editor", {
            placeholder:'本编辑器支持Markdown编辑，左边编写，右边预览',  //默认显示的文字，这里就不解释了
            // width: "90%",
            height: 940,
            syncScrolling: "single",
             /**设置主题颜色*/
            editorTheme: "default",
            theme: "simple",         //工具栏主题 ["default", "dark"]
            previewTheme: "default",           //预览主题  ["default", "dark"]
            // editorTheme: "pastel-on-white",      //编辑主题
            imageUpload : true, 
            imageFormats : ["jpg","jpeg","gif","png","bmp","webp"], 
            imageUploadURL : "/default/upload",       //上传图片使用方法
            saveHTMLToTextarea: true,
            emoji: true,
            taskList: true, 
            tocm: true,                  // Using [TOCM]
            tex: true,                   // 开启科学公式TeX语言支持，默认关闭
            // htmlDecode:"style,script,iframe",
            // flowChart: false,             // 开启流程图支持，默认关闭
//            sequenceDiagram: false,       // 开启时序/序列图支持，默认关闭
            // markdown: "",     // dynamic set Markdown text
            path : "../../resource/editormd/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
        });
        
    });

js;

$this->registerJs($js);
?>
