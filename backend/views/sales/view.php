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
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="material-icons">shopping_cart</i> ' . Yii::t('app', 'Dispositivos'), ['index-items', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="material-icons">card_giftcard</i> ' . Yii::t('app', 'Cerrar venta'), ['index-items', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="material-icons">print</i> ' . Yii::t('app', 'Imprimir'), ['print', 'id' => $model->id], ['class' => 'btn btn-success', 'disabled' => $model->status === 0]) ?>
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
            [
                'attribute' => 'customer_id',
                'label' => 'Código del cliente',
                'value' => $model->customer->code,
            ],
            [
                'attribute' => 'customer_id',
                'label' => 'Nombre',
                'value' => $model->customer->name,
            ],
            [
                'attribute' => 'customer_id',
                'label' => 'Teléfono',
                'value' => $model->customer->telephone,
            ],
            [
                'attribute' => 'date',
                'label' => AttributesLabels::getAttributeLabel('date'),
                'format' => 'date',
            ],
            [
                'attribute' => 'updated_at',
                'label' => AttributesLabels::getAttributeLabel('updated_at'),
                'format' => 'date',
            ],
            
        ],
    ]) ?>

</div>
