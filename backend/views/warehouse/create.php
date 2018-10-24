<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = Yii::t('app', 'Agregar dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacén'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
