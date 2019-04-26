<?php

use common\models\search\WorkshopSearch;
use common\utils\AttributesLabels;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel WorkshopSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Reparaciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar Reparación'), ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                [
                'label' => AttributesLabels::getAttributeLabel('status'),
                'attribute' => 'status',
                'content' => function ($searchModel) {
                    return $searchModel->status === 1 ? 'Cerrada' : 'Pendiente';
                },
                'filter' => [0 => 'Pendiente', 1 => 'Cerrada'],
            ],
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
                'attribute' => 'folio_number',
                'label' => AttributesLabels::getAttributeLabel('folio_number'),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view} {update} {index-payments} {delete} {print}',
                'buttons' =>
                    [
                    'view' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Detalles"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($key, $model) {
                        return $model->status === 0 ? '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Actualizar"><span class="glyphicon glyphicon-pencil"></span></a>' : '';
                    },
                    'index-payments' => function ($url, $searchModel) {
                        return $searchModel->status === 0 ? Html::a('<span class="glyphicon glyphicon-credit-card"></span>', $url, [
                                    'title' => Yii::t('yii', 'Anticipos'),
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => 0,
                                ]) : '';
                    },
                    'print' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>';
                    },
                    'delete' => function ($key, $model) {
                        return $model->status === 0 ? '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Eliminar" data-confirm="Confirmar eliminación de este elemento" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>' : '';
                    },
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
