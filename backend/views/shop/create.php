<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Shop */

$this->title = Yii::t('app', 'Agregar artículo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tienda'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
