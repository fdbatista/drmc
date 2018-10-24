<?php

use common\models\User;
use yii\web\View;


/* @var $this View */
/* @var $model User */

$this->title = Yii::t('app', 'Agregar usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
