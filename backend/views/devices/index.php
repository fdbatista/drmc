<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dispositivos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php Pjax::begin(); ?>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a(Yii::t('app', 'Agregar Dispositivo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'type',
                'value' => 'type.name'
            ],
            [
                'attribute' => 'model',
                'value' => 'model.name'
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
    ]);
    ?>
<?php Pjax::end(); ?>
</div>
