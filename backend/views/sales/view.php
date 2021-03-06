<?php

use common\models\Sale;
use common\utils\AttributesLabels;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Sale */

$this->title = 'Detalles de la venta';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-view">

    <p>
        <?= Html::a('<i class="material-icons">shopping_cart</i> ' . Yii::t('app', 'Dispositivos'), ['update-items', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="material-icons">card_giftcard</i> ' . Yii::t('app', 'Cerrar venta'), ['print', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="material-icons">delete</i> ' . Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Confirme que desea eliminar este elemento'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => AttributesLabels::getAttributeLabel('status'),
                'value' => $model->status === 1 ? 'Cerrada' : 'Abierta'
            ],
//            [
//                'attribute' => 'customer_id',
//                'label' => 'Código del cliente',
//                'value' => $model->customer->code,
//            ],
//            [
//                'attribute' => 'customer_id',
//                'label' => 'Nombre',
//                'value' => $model->customer->name,
//            ],
//            [
//                'attribute' => 'customer_id',
//                'label' => 'Teléfono',
//                'value' => $model->customer->telephone,
//            ],
            [
                'attribute' => 'date',
                'label' => AttributesLabels::getAttributeLabel('date'),
                'format' => 'date',
            ],
            [
                'attribute' => 'serial_number',
                'label' => AttributesLabels::getAttributeLabel('serial_number'),
            ],
            [
                'attribute' => 'total_price',
                'label' => AttributesLabels::getAttributeLabel('total_price'),
            ],
            [
                'attribute' => 'discount_applied',
                'label' => AttributesLabels::getAttributeLabel('discount_applied'),
            ],
            [
                'attribute' => 'updated_at',
                'label' => AttributesLabels::getAttributeLabel('updated_at'),
                'format' => 'date',
            ],
            
        ],
    ]) ?>

</div>
