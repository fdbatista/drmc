<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AppConfig */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración general'), 'url' => ['index']];
?>
<div class="app-config-view">


    <p>
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'app_title',
            'about',
            'address',
            'email:email',
            'phone',
        ],
    ]) ?>

</div>
