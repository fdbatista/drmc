<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppConfig */

$this->title = Yii::t('app', 'Actualizar configuración');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración general'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="app-config-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
