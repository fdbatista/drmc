<?php

use common\models\Branch;
use yii\web\View;

/* @var $this View */
/* @var $model Branch */

$this->title = 'Actualizar sucursal';
$this->params['breadcrumbs'][] = ['label' => 'Sucursales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="branch-update">
    <?= $this->render('_form', ['model' => $model ]) ?>
</div>
