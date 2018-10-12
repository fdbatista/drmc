<?php

use common\models\User;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model User */
/* @var $form ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => [10 => 'Activo', 0 => 'Inactivo'],
        'language' => 'es',
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Seleccione un elemento'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password_hash')->passwordInput() ?>
    <?= $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
