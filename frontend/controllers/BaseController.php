<?php

namespace frontend\controllers;

use frontend\dao\Common;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;


class BaseController extends Controller
{
    use Common;

//    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
       if (Yii::$app->user->isGuest) {
           return $this->redirect(['site/login', 'redirect' => ltrim(Url::current(), '/')])->send();
       }
        $this->view->params['data'] = array();  // 给View赋值参数data

        return parent::beforeAction($action);
    }
}