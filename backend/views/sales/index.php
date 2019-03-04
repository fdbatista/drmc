<?php

use common\models\search\SaleSearch;
use common\utils\AttributesLabels;
use kartik\daterange\DateRangePicker;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel SaleSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Ventas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar venta'), ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                [
                'label' => AttributesLabels::getAttributeLabel('status'),
                'attribute' => 'status',
                'content' => function ($searchModel) {
                    return $searchModel->status === 1 ? 'Cerrada' : 'Abierta';
                },
                'filter' => [0 => 'Abierta', 1 => 'Cerrada']
            ],
                [
                'attribute' => 'date',
                'label' => AttributesLabels::getAttributeLabel('date'),
                'format' => 'text',
                'filter' => 
                DateRangePicker::widget([
                    'name' => 'SaleSearch[date]',
                    'pluginOptions' => [
                        'locale' => [
                            'separator' => ' al ',
                        ],
                        'opens' => 'right'
                    ]
                ]),
                'content' => function($data) {
                    return Yii::$app->formatter->asDatetime($data['date'], "php:Y-m-d");
                }
            ],
                [
                'attribute' => 'customer',
                'label' => AttributesLabels::getAttributeLabel('customer_id'),
                'value' => 'customer.code',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view} {update} {index-items} {delete}',
                'buttons' =>
                    [
                    'view' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Detalles"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Actualizar"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'index-items' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', $url, [
                                    'title' => Yii::t('yii', 'Dispositivos'),
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => 0,
                        ]);
                    },
                    'delete' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Eliminar" data-confirm="Confirmar eliminación de este elemento" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                    }
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
