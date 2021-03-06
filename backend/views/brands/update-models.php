<?php

/* @var $this yii\web\View */
/* @var $model common\models\BrandModel */

$this->title = Yii::t('app', 'Actualizar modelo');
$brand = $model->getBrand()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index-models', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view-models', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-model-update">
    <?= $this->render('_form-model', ['model' => $model]) ?>
</div>
