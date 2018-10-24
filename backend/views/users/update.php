<?php

use common\models\User;
use yii\web\View;

/* @var $this View */
/* @var $model User */

$this->title = Yii::t('app', 'Actualizar usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="user-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
