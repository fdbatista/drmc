<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */

$this->title = Yii::t('app', 'Agregar Artículo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Artículos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
