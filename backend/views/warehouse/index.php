<?php

use common\models\search\WarehouseSearch;
use common\utils\AttributesLabels;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
/* @var $this View */
/* @var $searchModel WarehouseSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Almacén');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar Artículo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'type',
                'label' => AttributesLabels::getAttributeLabel('type'),
                'value' => 'type.name'
            ],
            [
                'attribute' => 'model',
                'label' => AttributesLabels::getAttributeLabel('model'),
                'value' => 'model.name'
            ],
            [
                'attribute' => 'code',
                'label' => AttributesLabels::getAttributeLabel('code'),
            ],
            [
                'attribute' => 'name',
                'label' => AttributesLabels::getAttributeLabel('name'),
            ],
            [
                'attribute' => 'items',
                'label' => AttributesLabels::getAttributeLabel('items'),
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
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>';
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
