<?php

use common\models\Branch;
use yii\web\View;


/* @var $this View */
/* @var $model Branch */

$this->title = 'Agregar sucursal';
$this->params['breadcrumbs'][] = ['label' => 'Sucursales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
