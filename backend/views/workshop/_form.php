<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Workshop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workshop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_id')->textInput() ?>

    <?= $form->field($model, 'pre_diagnosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_in')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_out')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'effort')->textInput() ?>

    <?= $form->field($model, 'receiver_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
