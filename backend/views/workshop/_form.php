<?php

use common\models\Workshop;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */
?>

<div class="workshop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'device_id')->widget(Select2::classname(), [
        'data' => StaticMembers::getDevices(),
        'language' => 'es',
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Seleccione un elemento'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'pre_diagnosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_in')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_out')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'effort')->textInput() ?>

    <?= $form->field($model, 'receiver_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
