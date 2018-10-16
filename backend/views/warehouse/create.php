<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */

$this->title = Yii::t('app', 'Agregar artículo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacén'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
