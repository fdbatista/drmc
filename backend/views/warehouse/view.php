<?php

use common\models\Stock;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Shop */

$this->title = 'Detalles del dispositivo';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacén'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-view">

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
                'attribute' => 'deviceType',
                'label' => AttributesLabels::getAttributeLabel('device_type'),
                'value' => $model->getDeviceType()->one()->name
            ],
            [
                'attribute' => 'brandModel',
                'label' => AttributesLabels::getAttributeLabel('model'),
                'value' => StaticMembers::getModelAndBrandName($model->getBrandModel()->one())
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
            [
                'attribute' => 'first_discount',
                'label' => AttributesLabels::getAttributeLabel('first_discount'),
            ],
            [
                'attribute' => 'major_discount',
                'label' => AttributesLabels::getAttributeLabel('major_discount'),
            ],
        ],
    ]) ?>

</div>
