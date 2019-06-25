<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= $this->title ?> · Blog</title>
        <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->head() ?>
        <link rel="stylesheet" href="<?= \yii\helpers\Url::home() ?>css/auth.css">

    </head>
<body>
<?php $this->beginBody() ?>

<div class="lowin">
    <div class="lowin-brand">
        <img src="<?= \yii\helpers\Url::home() ?>img/kodinger.jpg" alt="logo">
    </div>
    <!-- /.login-logo -->
    <?= $content ?>
    <!-- /.login-box-body -->
</div>

<?php $this->endBody() ?>
<script src="<?= \yii\helpers\Url::home() ?>js/auth.js"></script>
<script>
    Auth.init({
        login_url: "<?= Url::to('site/login', true)?>",
        forgot_url: "<?= Url::to('site/forget', true)?>"
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
