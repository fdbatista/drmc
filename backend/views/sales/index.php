<?php

use common\models\search\SaleSearch;
use common\utils\AttributesLabels;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
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
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar venta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $form = ActiveForm::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                [
                'attribute' => 'date',
                'label' => AttributesLabels::getAttributeLabel('date'),
                /*'filter' => DateRangePicker::widget([
                    'name' => 'date_range_1',
                    'value' => '01-Jan-14 to 20-Feb-14',
                    'convertFormat' => true,
                    'useWithAddon' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'd-M-y',
                            'separator' => ' to ',
                        ],
                        'opens' => 'left'
                    ]
                ])*/
            /* DatePicker::widget([
              'name' => 'start_date',
              'name2' => 'end_date',
              'language' => 'es',
              'type' => DatePicker::TYPE_RANGE,
              'pluginOptions' => [
              'autoclose' => false,
              'format' => 'yyyy-mm-dd',
              ]
              ]) */
            ],
            /* [
              'attribute2' => 'end_date',
              'label' => AttributesLabels::getAttributeLabel('date'),
              'filter' => DatePicker::widget([
              //'name' => 'date',
              'language' => 'es',
              'type' => DatePicker::TYPE_RANGE,
              'pluginOptions' => [
              'autoclose' => false,
              'format' => 'yyyy-mm-dd',
              ]
              ])
              ], */
                [
                'attribute' => 'customer',
                'label' => AttributesLabels::getAttributeLabel('customer_id'),
                'value' => 'customer.fullname'
            ],
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view} {update} {delete} {index-items}',
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
                                    'title' => Yii::t('yii', 'Artículos'),
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
    ActiveForm::end();
    ?>
    <?php Pjax::end(); ?>
</div>
