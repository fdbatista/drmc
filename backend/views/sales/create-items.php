<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SaleItem */

$this->title = Yii::t('app', 'Agregar dispositivo');
$parent = $model->getSale()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles de la venta'), 'url' => ['view', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dispositivos'), 'url' => ['index-items', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-item-create">
    <?= $this->render('_form-items', ['model' => $model]) ?>
</div>
