<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Workshop */

$this->title = Yii::t('app', 'Actualizar Workshop: ' . $model->device_id, [
    'nameAttribute' => '' . $model->device_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Artículos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->device_id, 'url' => ['view', 'id' => $model->device_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="workshop-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
