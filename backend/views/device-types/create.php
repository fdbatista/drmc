<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeviceType */

$this->title = Yii::t('app', 'Agregar Tipo de Dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos de dispositivo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-type-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
