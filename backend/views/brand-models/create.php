<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BrandModel */

$this->title = Yii::t('app', 'Agregar Modelo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modelos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-model-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
