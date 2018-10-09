<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Workshop */

$this->title = Yii::t('app', 'Create Workshop');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
