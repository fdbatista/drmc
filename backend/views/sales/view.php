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
        <?= Html::a('<i class="material-icons">shopping_cart</i> ' . Yii::t('app', 'Artículos'), ['index-items', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="material-icons">card_giftcard</i> ' . Yii::t('app', 'Cerrar venta'), ['index-items', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
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
                'attribute' => 'customer_id',
                'label' => AttributesLabels::getAttributeLabel('customer_id'),
                'value' => $model->getCustomer()->one()->code,
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
