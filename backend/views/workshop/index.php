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

    <!--<h3><?= Html::encode($this->title) ?></h3>-->
    <?php Pjax::begin(); ?>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar Artículo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
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
                'attribute' => 'pre_diagnosis',
                'label' => AttributesLabels::getAttributeLabel('pre_diagnosis'),
            ],
                [
                'attribute' => 'observations',
                'label' => AttributesLabels::getAttributeLabel('observations'),
            ],
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view} {update} {index-payments} {delete}',
                'buttons' =>
                    [
                    'view' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Detalles"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Actualizar"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'index-payments' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-credit-card"></span>', $url, [
                                    'title' => Yii::t('yii', 'Cotizaciones'),
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => 0,
                        ]);
                    },
                    'delete' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Eliminar" data-confirm="Confirmar eliminación de este elemento" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
