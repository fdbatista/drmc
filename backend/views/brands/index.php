<?php

use common\models\search\BrandSearch;
use common\utils\AttributesLabels;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel BrandSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Marcas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar marca'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                [
                'attribute' => 'name',
                'label' => AttributesLabels::getAttributeLabel('name'),
            ],
                [
                'attribute' => 'description',
                'label' => AttributesLabels::getAttributeLabel('description'),
            ],
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['class' => 'actions-grid-header'],
                'template' => '{view} {update} {delete} {index-models}',
                'buttons' =>
                    [
                    'view' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Detalles"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($key) {
                        return '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'index-models' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-tag"></span>', $url, [
                                    'title' => Yii::t('yii', 'Modelos'),
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
