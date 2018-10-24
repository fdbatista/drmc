<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Workshop */

$this->title = Yii::t('app', 'Agregar dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-create">
    <?= $this->render('_form', ['model' => $model, 'passwordOrPattern' => $passwordOrPattern]) ?>
</div>
