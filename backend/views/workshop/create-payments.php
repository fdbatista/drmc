<?php

use common\models\WorkshopPayment;
use yii\web\View;


/* @var $this View */
/* @var $model WorkshopPayment */

$this->title = Yii::t('app', 'Agregar anticipo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anticipos'), 'url' => ['index-payments', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-payment-create">

    <?= $this->render('_form-payments', ['model' => $model, 'parent' => $parent]) ?>

</div>
