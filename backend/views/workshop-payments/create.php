<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WorkshopPayment */

$this->title = Yii::t('app', 'Agregar Workshop Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshop Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-payment-create">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
