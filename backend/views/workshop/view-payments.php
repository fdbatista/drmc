<?php

use common\models\WorkshopPayment;
use common\utils\AttributesLabels;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model WorkshopPayment */

$this->title = Yii::t('app', 'Detalles de la cotización');
$parent = $model->getWorkshop()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cotizaciones'), 'url' => ['index-payments', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-payment-view">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <p>
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update-payments', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('<i class="material-icons">delete</i> ' . Yii::t('app', 'Eliminar'), ['delete-payments', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Confirme que desa eliminar este elemento'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                'attribute' => 'amount',
                'label' => AttributesLabels::getAttributeLabel('amount'),
            ], [
                'attribute' => 'date',
                'format' => 'date',
                'label' => AttributesLabels::getAttributeLabel('date'),
            ],
        ],
    ])
    ?>

</div>
