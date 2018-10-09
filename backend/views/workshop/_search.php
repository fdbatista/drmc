<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\WorkshopSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workshop-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'pre_diagnosis') ?>

    <?= $form->field($model, 'password_pattern') ?>

    <?= $form->field($model, 'observations') ?>

    <?= $form->field($model, 'signature_in') ?>

    <?php // echo $form->field($model, 'signature_out') ?>

    <?php // echo $form->field($model, 'effort') ?>

    <?php // echo $form->field($model, 'receiver_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
