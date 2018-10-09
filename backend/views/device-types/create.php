<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeviceType */

$this->title = Yii::t('app', 'Create Device Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Device Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
