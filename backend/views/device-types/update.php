<?php

/* @var $this yii\web\View */
/* @var $model common\models\DeviceType */

$this->title = Yii::t('app', 'Actualizar tipo de dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos de dispositivo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="device-type-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
