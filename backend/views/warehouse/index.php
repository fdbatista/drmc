<?php

use common\models\search\StockSearch;
use common\utils\AttributesLabels;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
/* @var $this View */
/* @var $searchModel StockSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Almacén');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar Dispositivo'), ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'deviceType',
                'label' => AttributesLabels::getAttributeLabel('device_type'),
                'value' => 'deviceType.name',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
            [
                'attribute' => 'brandModel',
                'label' => AttributesLabels::getAttributeLabel('model'),
                'value' => 'brandModel.name',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
            [
                'attribute' => 'code',
                'label' => AttributesLabels::getAttributeLabel('code'),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
            [
                'attribute' => 'items',
                'label' => AttributesLabels::getAttributeLabel('items'),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view} {update} {delete}',
                'buttons' =>
                    [
                    'view' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Detalles"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Actualizar"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'delete' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Eliminar" data-confirm="Confirmar eliminación de este elemento" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
