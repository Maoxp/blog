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
        <div class="col-xs-12 col-sm-9">
            <div class="row">
                <?php foreach ($rows as $k => $row): ?>
                    <div class="col-xs-6 col-lg-4">
                        <h2><?= $row['name'] ?></h2>
                        <p class="label label-info">文章数：<?= $row['aticle_count'] ?> </p>
                        <p><a class="btn btn-default" href="<?= Url::to(['default/list', 'id'=> $row['id']]) ?>" role="button">详情 »</a></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
