<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BrandModel */

$this->title = $model->name;
$brand = $model->getBrand()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['models', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-model-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['model-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['model-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description',
        ],
    ]) ?>

</div>
