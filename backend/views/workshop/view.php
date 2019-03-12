<?php

use common\models\Workshop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Workshop */

$this->title = 'Datos del dispositivo';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-view">

    <p>
        <?php
        echo Html::a('<i class="material-icons">print</i> ' . Yii::t('app', 'Imprimir'), ['print', 'id' => $model->id], ['class' => 'btn btn-success']);

        if ($model->status === 0) {
            echo Html::a('<i class="material-icons">credit_card</i> ' . Yii::t('app', 'Cotizaciones'), ['index-payments', 'id' => $model->id], ['class' => 'btn btn-info']);
            echo Html::a('<i class="material-icons">healing</i> ' . Yii::t('app', 'Cerrar reparación'), ['finish-repair', 'id' => $model->id], ['class' => 'btn btn-warning']);
            echo Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('<i class="material-icons">delete</i> ' . Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Confirme que desa eliminar este elemento'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                'label' => AttributesLabels::getAttributeLabel('status'),
                'value' => $model->status === 1 ? 'Cerrada' : 'Pendiente'
            ],
                [
                'attribute' => 'deviceType',
                'label' => AttributesLabels::getAttributeLabel('device_type'),
                'value' => $model->deviceType->name
            ],
                [
                'attribute' => 'brandModel',
                'label' => AttributesLabels::getAttributeLabel('model'),
                'value' => StaticMembers::getModelAndBrandName($model->brandModel),
            ],
                [
                'attribute' => 'serial_number',
                'label' => AttributesLabels::getAttributeLabel('serial_number'),
            ],
                [
                'attribute' => 'customer_name',
                'label' => AttributesLabels::getAttributeLabel('customer_name'),
            ],
                [
                'attribute' => 'customer_telephone',
                'label' => AttributesLabels::getAttributeLabel('customer_telephone'),
            ],
                [
                'attribute' => 'folio_number',
                'label' => AttributesLabels::getAttributeLabel('folio_number'),
            ],
                [
                'attribute' => 'password',
                'label' => AttributesLabels::getAttributeLabel('password'),
            ],
                [
                'attribute' => 'pattern',
                'label' => AttributesLabels::getAttributeLabel('pattern'),
            ],
                [
                'attribute' => 'observations',
                'label' => AttributesLabels::getAttributeLabel('observations'),
            ],
                [
                'attribute' => 'effort',
                'label' => AttributesLabels::getAttributeLabel('effort'),
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
                'attribute' => 'warranty_until',
                'label' => AttributesLabels::getAttributeLabel('warranty_until'),
            ],
                [
                'attribute' => 'receiver_id',
                'label' => AttributesLabels::getAttributeLabel('receiver_id'),
                'value' => $model->getReceiver()->one()->getFullName()
            ],
                [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'label' => AttributesLabels::getAttributeLabel('updated_at'),
            ],
        ],
    ])
    ?>

</div>
