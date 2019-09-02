<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/7/4
 * Time: 11:12
 */

$this->title = '归档';

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

        </style>
        <?php foreach ($rows as $k => $row): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="thumbnail" style="height: 298px;">
                    <a href="<?= Url::to(['default/list', 'type'=> 'tag', "keyword" => $row['id']]) ?>" title="" target="_blank">
                        <?php
                            switch ((int)$row['id']) {
                                case 1:
                                    $src = "/img/tag/php.jpg";
                                    break;
                                case 2:
                                    $src = "/img/tag/python.jpg";
                                    break;
                                case 3:
                                    $src = "/img/tag/mysql.jpg";
                                    break;
                                case 4:
                                    $src = "/img/tag/linux.jpg";
                                    break;
                                case 5:
                                    $src = "/img/tag/composer.jpg";
                                    break;
                                case 6:
                                    $src = "/img/tag/git.jpg";
                                    break;
                                case 8:
                                    $src = "/img/tag/html_css_jq.jpg";
                                    break;
                                default:
                                    $src = "/img/about-bg.jpg";
                            }
                        ?>
                        <img class="lazy" src="<?= $src; ?>" alt="图片" style="max-width:100%;width: 300px;height: 150px">
                    </a>
                    <div class="caption">
                        <h3>
                            <a href="#" title=""><?= $row['name'] ?></a>
                        </h3> <small class="label label-default"><?= $row['aticle_count'] ?></small>
                        <br>
                        <p><a class="btn btn-default" href="<?= Url::to(['default/list', 'type'=> 'tag', "keyword" => $row['id']]) ?>" role="button" style="float: right;">详情 »</a></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
