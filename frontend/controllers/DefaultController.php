<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/21
 * Time: 14:27
 */

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index',[
            'js_list' => [],
            'css_list' => [],
        ]);
    }

    public function actionDetail()
    {
        return $this->render('detail',[
            'js_list' => ['resource/editormd/editormd.min.js', "js/editormd.js"],
            'css_list' => ['resource/editormd/css/editormd.min.css'],
        ]);
    }
}