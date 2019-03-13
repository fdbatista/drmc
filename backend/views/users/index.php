<?php

use common\models\search\UserSearch;
use common\utils\AttributesLabels;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar usuario'), ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'username',
                'label' => AttributesLabels::getAttributeLabel('username'),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
            [
                'attribute' => 'email',
                'label' => AttributesLabels::getAttributeLabel('email'),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca un criterio...'
                ],
            ],
            [
                'label' => AttributesLabels::getAttributeLabel('status'),
                'attribute' => 'status',
                'content' => function ($searchModel) {
                        return $searchModel->status === 10 ? 'Activo' : 'Inactivo';
                    },
                'filter' => [0 => 'Inactivo', 10 => 'Activo']
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
                    'delete' => function ($key, $searchModel) {
                        return Yii::$app->user->identity->id !== $searchModel->id ? '<a href="' . $key . '" data-toggle="tooltip" data-placement="top" title="Eliminar" data-confirm="Confirmar eliminación de este elemento" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>' : '';
                    },
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
