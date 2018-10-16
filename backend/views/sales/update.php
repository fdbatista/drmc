<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = Yii::t('app', 'Actualizar venta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles de la venta'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="sale-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
