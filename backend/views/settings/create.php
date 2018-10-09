<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AppConfig */

$this->title = Yii::t('app', 'Create App Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'App Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
