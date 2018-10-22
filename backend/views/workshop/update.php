<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Workshop */

$this->title = Yii::t('app', 'Actualizar dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="workshop-update">
    <?= $this->render('_form', ['model' => $model, 'passwordOrPattern' => $passwordOrPattern]) ?>
</div>
