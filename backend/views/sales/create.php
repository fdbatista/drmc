<?php

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = Yii::t('app', 'Agregar venta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
