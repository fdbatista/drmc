<?php
/* @var $this View */
/* @var $content string */

use backend\assets\LoginAsset;
use ramosisw\CImaterial\web\MaterialAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/*
  use yii\dependencies
 */

LoginAsset::register($this);
MaterialAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <link rel="shortcut icon" type=image/png href="<?= Url::to('@web/img/favicon.png') ?>">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
