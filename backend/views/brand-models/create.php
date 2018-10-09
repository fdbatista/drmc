<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BrandModel */

$this->title = Yii::t('app', 'Create Brand Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brand Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
