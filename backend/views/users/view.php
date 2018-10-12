<?php

use common\models\User;
use common\utils\AttributesLabels;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= $model->username !== 'admin' ? Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => AttributesLabels::getAttributeLabel('username'),
                'value' => $model->username
            ],
            [
                'label' => AttributesLabels::getAttributeLabel('email'),
                'value' => $model->email,
                'format' => 'email'
            ],
            [
                'label' => AttributesLabels::getAttributeLabel('status'),
                'value' => $model->status === 10 ? 'Activo' : 'Inactivo'
            ],
            [
                'label' => AttributesLabels::getAttributeLabel('created_at'),
                'value' => $model->created_at,
                'format' => 'datetime'
            ],
            [
                'label' => AttributesLabels::getAttributeLabel('updated_at'),
                'value' => $model->updated_at,
                'format' => 'datetime'
            ],
        ],
    ]) ?>

</div>
