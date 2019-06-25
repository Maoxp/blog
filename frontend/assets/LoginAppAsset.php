<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/24
 * Time: 8:21
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class LoginAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'resource/bootstrap/css/bootstrap.min.css',
    ];
    public $js = [
//        'resource/jquery/jquery.min.js',
//        'resource/bootstrap/js/bootstrap.bundle.min.js',

    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), "depends" => "frontend\assets\LoginAppAsset"]);
    }
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), "depends" => "frontend\assets\LoginAppAsset"]);
    }

}