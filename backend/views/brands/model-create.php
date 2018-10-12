<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BrandModel */

$this->title = Yii::t('app', 'Agregar Modelo');
$brand = $model->getBrand()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['models', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-model-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form-model', [
        'model' => $model,
    ]) ?>

</div>
