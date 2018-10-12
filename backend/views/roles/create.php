<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Role */

$this->title = Yii::t('app', 'Agregar Rol');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
