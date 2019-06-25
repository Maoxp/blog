<?php

/* @var $this yii\web\View */

$this->title = '首页';

use frontend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

if (isset($js_list)) {
    foreach ($js_list as $k => $href) {
        AppAsset::addScript($this, Url::home().$href);
    }
}
if (isset($css_list)) {
    foreach ($css_list as $k => $href) {
        AppAsset::addCss($this, Url::home().$href);
    }
}
?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <a href="#">
                    <h3 class="post-title">
                        一种自顶而下的Python装饰器设计方法
                    </h3>
                    <h4 class="post-subtitle">
                        装饰器是 Python 的一种重要编程实践，然而如果没有掌握其原理和适当的方法，写 Python 装饰器时就可能遇到各种困难。 ...
                    </h4>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on September 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="#">
                    <h3 class="post-title">
                        2018 - 我的学生生涯最后一年回顾.
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on September 18, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="#">
                    <h3 class="post-title">
                        Python提取支付宝和微信支付二维码.
                    </h3>
                    <h4 class="post-subtitle">
                        支付宝或者微信支付导出的收款二维码，除了二维码部分，还有很大一块背景图案，例如下面就是微信支付的收款二维码： 有时候我们仅仅只想要图片中间的方形二维码部分，为了提取出中间部分，我们可以使用图片处理软件，但图片处理软件不利于批处理，且学习也需要一定成本.
                    </h4>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on August 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="#">
                    <h3 class="post-title">
                        帮小姐姐发一条杭州有赞的内推消息 (校招、实习都可)
                    </h3>
                    <h4 class="post-subtitle">
                        有赞大家都知道，是一个总部位于杭州专注于在线商城开发的互联网公司。小姐姐目前在共享技术团队实习，组内大都是来自阿里、网易的牛人，技术氛围很好，组里十分缺人，leader求贤若渴.
                    </h4>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on July 8, 2019</p>
            </div>
            <hr>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    </div>
</div>