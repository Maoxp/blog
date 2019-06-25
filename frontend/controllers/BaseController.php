<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\helpers\Url;

use yii\base\InvalidParamException;
use yii\log\FileTarget;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\LinkPager;


class BaseController extends Controller
{

//    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
       if (Yii::$app->user->isGuest) {
           return $this->redirect(['site/login', 'redirect' => ltrim(Url::current(), '/')])->send();
       }
        $this->view->params['data'] = array();  // 给View赋值参数data

        return parent::beforeAction($action);
    }


    //分页
    public function createPage($count, $pageSize)
    {
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize, 'pageSizeParam' => 'pageSize' ]);

        return LinkPager::widget([
            'pagination' => $pages,
            'firstPageLabel' => "首页",
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'lastPageLabel' => '尾页',
            'hideOnSinglePage' => false,    //不够2页， 默认不显示分页
            'maxButtonCount' => 10,  //默认显示的页码为10页， 设置你想要展示的页数
            'options' => ['class' => 'pagination pagination-sm no-margin pull-right'],   //不喜欢默认的样式，想要分页带上自己的样式，可以设置options，不要忘了自行实现pre,next,disabled等样式
        ]);
    }




}