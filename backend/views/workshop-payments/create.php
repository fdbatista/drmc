<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WorkshopPayment */

$this->title = Yii::t('app', 'Create Workshop Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshop Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
