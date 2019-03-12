<?php

use common\models\Brand;
use yii\web\View;


/* @var $this View */
/* @var $model Brand */

$this->title = Yii::t('app', 'Agregar marca');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
