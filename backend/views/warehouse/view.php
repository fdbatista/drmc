<?php

use common\models\Warehouse;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Warehouse */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacén'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-view">
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
                'attribute' => 'name',
                'label' => AttributesLabels::getAttributeLabel('name'),
            ],
            [
                'attribute' => 'code',
                'label' => AttributesLabels::getAttributeLabel('code'),
            ],
            
            [
                'attribute' => 'price_in',
                'label' => AttributesLabels::getAttributeLabel('price_in'),
            ],
            [
                'attribute' => 'price_public',
                'label' => AttributesLabels::getAttributeLabel('price_public'),
            ],
        ],
    ]) ?>

</div>
