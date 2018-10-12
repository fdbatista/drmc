<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Device */

$this->title = Yii::t('app', 'Agregar Dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dispositivos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
