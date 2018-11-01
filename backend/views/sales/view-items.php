<?php

use common\models\SaleItem;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model SaleItem */

$this->title = 'Detalles';
$parent = $model->getSale()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles de la venta'), 'url' => ['view', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dispositivos'), 'url' => ['index-items', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = $this->title;?>
<div class="sale-item-view">

    <p>
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update-items', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'attribute' => 'deviceType',
                'label' => AttributesLabels::getAttributeLabel('device_type'),
                'value' => $model->deviceType->name
            ],
            [
                'attribute' => 'brandModel',
                'label' => AttributesLabels::getAttributeLabel('model'),
                'value' => StaticMembers::getModelAndBrandName($model->brandModel)
            ],
            [
                'attribute' => 'price_in',
                'label' => AttributesLabels::getAttributeLabel('price_in'),
            ],
            [
                'attribute' => 'items',
                'label' => AttributesLabels::getAttributeLabel('items'),
            ],
            [
                'attribute' => 'price_out',
                'label' => AttributesLabels::getAttributeLabel('price_out'),
            ],
            [
                'attribute' => 'discount_applied',
                'label' => AttributesLabels::getAttributeLabel('discount_applied'),
            ],
            [
                'attribute' => 'final_price',
                'label' => AttributesLabels::getAttributeLabel('final_price'),
            ],
            [
                'attribute' => 'updated_at',
                'label' => AttributesLabels::getAttributeLabel('updated_at'),
                'format' => 'date'
            ],
        ],
    ]) ?>

</div>
