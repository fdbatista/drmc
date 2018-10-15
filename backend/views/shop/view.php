<?php

use common\models\Shop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Shop */

$this->title = 'Venta de artículo';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Artículos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-view">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <p>
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="material-icons">delete</i> ' . Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
                'attribute' => 'inventory',
                'label' => AttributesLabels::getAttributeLabel('inventory'),
            ],
            [
                'attribute' => 'code',
                'label' => AttributesLabels::getAttributeLabel('code'),
            ],
            [
                'attribute' => 'items',
                'label' => AttributesLabels::getAttributeLabel('items'),
            ],
            [
                'attribute' => 'price_in',
                'label' => AttributesLabels::getAttributeLabel('price_in'),
            ],
            [
                'attribute' => 'price_out',
                'label' => AttributesLabels::getAttributeLabel('price_out'),
            ],
        ],
    ]) ?>

</div>
