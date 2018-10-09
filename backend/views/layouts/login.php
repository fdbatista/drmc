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
//Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    MaterialAsset::register($this);
}

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
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
