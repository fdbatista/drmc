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
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="material-icons">credit_card</i> ' . Yii::t('app', 'Cotizaciones'), ['index-payments', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'pre_diagnosis',
                'label' => AttributesLabels::getAttributeLabel('pre_diagnosis'),
            ],
            [
                'attribute' => 'password',
                'label' => AttributesLabels::getAttributeLabel('password'),
            ],
            [
                'attribute' => 'pattern',
                'label' => AttributesLabels::getAttributeLabel('pattern'),
                'format' => ['image', ['height' => '100']],
                
            ],
            [
                'attribute' => 'observations',
                'label' => AttributesLabels::getAttributeLabel('observations'),
            ],
            [
                'attribute' => 'signature_in',
                'label' => AttributesLabels::getAttributeLabel('signature_in'),
            ],
            [
                'attribute' => 'signature_out',
                'label' => AttributesLabels::getAttributeLabel('signature_out'),
            ],
            [
                'attribute' => 'effort',
                'label' => AttributesLabels::getAttributeLabel('effort'),
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
    ]) ?>

</div>
