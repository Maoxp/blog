<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/7/4
 * Time: 11:12
 */

$this->title = '首页';

use frontend\assets\AppAsset;
use yii\helpers\Url;

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

<div class="container">
    <div class="row">
        <style>
            .default-list-ul li {
                list-style: none;
            }
            .default-list-ul li h3 {
                line-height: 2;
                padding: 0 10px;
                background: #F3F3F3;
            }
            .border {
                padding: 10px;
                width: auto;
                border: 1px solid #8c899433;
                border-top: none;
                border-left: none;
                border-right: none;
            }
        </style>
        <ul class="default-list-ul">
            <?php foreach ($rows as $row): ?>
            <li>
                <a href="<?= Url::to(['default/detail', "id"=> $row['id']])?>" class="post-title">
                    <h3><?= $row['title']?></h3>
                </a>
                <div class="border">
                    <p><?= $row['subtitle']?></p>
                    <span style="color: #777; margin-right: 1rem !important;"> <i class="fa fa-eye" aria-hidden="true"><?= $row['reads']?></i> </span>
                    <span style="color: #777; margin-right: 1rem !important;"> <i class="fa fa-comments" aria-hidden="true"> 0</i></span>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Pager -->
    <div class="row">
        <div>
            显示第 <?= ($page-1)*$pageSize +1  ?> 至 <?= ($page-1) * $pageSize + count($rows) ?> 项结果，
            共 <?= $total  ?> 项
        </div>
        <?= $pagination ?>
    </div>
</div>
