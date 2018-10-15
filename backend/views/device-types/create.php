<?php

/* @var $this yii\web\View */
/* @var $model common\models\DeviceType */

$this->title = Yii::t('app', 'Agregar tipo de dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos de dispositivo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-type-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
