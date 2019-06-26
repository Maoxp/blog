<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resource/bootstrap/css/bootstrap.min.css',
        'resource/bootstrap/css/bootstrap.theme.css',
        'resource/font-awesome/css/font-awesome.min.css',
        'resource/toopay-bootstrap-markdown/css/bootstrap-markdown.min.css',
        'css/site.min.css',
    ];
    public $js = [
        'resource/jquery/jquery.min.js',
        'resource/bootstrap/js/bootstrap.min.js',
        'resource/toopay-bootstrap-markdown/js/bootstrap-markdown.js',
        'resource/toopay-bootstrap-markdown/locale/bootstrap-markdown.zh.js',
        'https://cdn.jsdelivr.net/npm/marked/marked.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsFile) {
        $view->registerJsFile($jsFile, [AppAsset::className(), "depends" => "frontend\assets\AppAsset", 'position'=>View::POS_END]);
    }
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssFile) {
        $view->registerCssFile($cssFile, [AppAsset::className(), "depends" => "frontend\assets\AppAsset", 'position'=>View::POS_END]);
    }
}
