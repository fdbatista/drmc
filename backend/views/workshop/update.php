<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Workshop */

$this->title = Yii::t('app', 'Actualizar reparación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos de la reparación'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="workshop-update">
    <?= $this->render('_form', ['model' => $model, 'passwordOrPattern' => $passwordOrPattern]) ?>
</div>
