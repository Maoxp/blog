<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/25
 * Time: 15:24
 */
namespace frontend\service;

use Yii;
use yii\data\Pagination;
use yii\widgets\LinkPager;

trait Common
{
    //分页
    public static function createPage($count, $pageSize)
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
            'options' => ['class' => 'pagination pagination-sm no-margin pull-left'],   //不喜欢默认的样式，想要分页带上自己的样式，可以设置options，不要忘了自行实现pre,next,disabled等样式
        ]);
    }

}