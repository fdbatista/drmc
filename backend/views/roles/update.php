<?php

use common\models\Role;
use yii\web\View;

/* @var $this View */
/* @var $model Role */

$this->title = Yii::t('app', 'Actualizar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', "Actualizar $model->name");
?>
<div class="role-update">
    <?= $this->render('_form', ['model' => $model, 'isNewRole' => false, 'perms' => $perms]) ?>
</div>
