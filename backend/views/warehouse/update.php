<?php

use common\models\Stock;
use yii\web\View;

/* @var $this View */
/* @var $model Stock */

$this->title = Yii::t('app', 'Actualizar dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacén'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles del dispositivo'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="shop-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
