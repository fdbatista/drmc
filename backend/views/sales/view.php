<?php

use common\models\Sale;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Sale */

$this->title = 'Datos de la venta';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-view">

    <p>
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="material-icons">delete</i> ' . Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Confirme que desa eliminar este elemento'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'type',
                'label' => AttributesLabels::getAttributeLabel('type'),
                'value' => $model->getType()->one()->name
            ],
            [
                'attribute' => 'model',
                'label' => AttributesLabels::getAttributeLabel('model'),
                'value' => StaticMembers::getModelAndBrandName($model->getModel()->one())
            ],
            [
                'attribute' => 'price_in',
                'label' => AttributesLabels::getAttributeLabel('price_in'),
            ],
            [
                'attribute' => 'price_out',
                'label' => AttributesLabels::getAttributeLabel('price_out'),
            ],
            [
                'attribute' => 'items',
                'label' => AttributesLabels::getAttributeLabel('items'),
            ],
        ],
    ]) ?>

</div>
