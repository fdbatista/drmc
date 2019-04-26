<?php

use common\models\search\WorkshopPaymentSearch;
use common\utils\AttributesLabels;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
/* @var $this View */
/* @var $searchModel WorkshopPaymentSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Anticipos');
$parent = $searchModel->getWorkshop()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos de la reparación'), 'url' => ['view', 'id' => $parent->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-payment-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar Anticipo'), ['create-payments', 'id' => $parent->id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'amount',
                'label' => AttributesLabels::getAttributeLabel('amount'),
            ],
            [
                'attribute' => 'date',
                'label' => AttributesLabels::getAttributeLabel('date'),
                'format' => 'datetime'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view-payments} {update-payments} {delete-payments}',
                'buttons' =>
                    [
                    'view-payments' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Detalles"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update-payments' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Actualizar"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'delete-payments' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Eliminar" data-confirm="Confirmar eliminación de este elemento" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
