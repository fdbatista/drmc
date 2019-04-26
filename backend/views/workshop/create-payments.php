<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WorkshopPayment */

$this->title = Yii::t('app', 'Agregar anticipo');
$parent = $model->getWorkshop()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anticipos'), 'url' => ['index-payments', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-payment-create">

    <?= $this->render('_form-payments', ['model' => $model]) ?>

</div>
