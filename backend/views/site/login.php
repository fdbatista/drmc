<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model common\models\LoginForm */

use common\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Acceder';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg" style="background-image:url(<?= Url::to('@web/login-assets/pages/img/login/bg1.jpg') ?>)">
                <img class="login-logo" src="<?= Url::to('@web/login-assets/pages/img/login/logo.png') ?>" />
            </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content">
                <div class="row">
                    <div class="col-xs-12">
                        <h1>Administraci&oacute;n</h1>
                        <p>Bienvenido a su interfaz de administraci&oacute;n.<br />Por favor, introduzca sus datos para continuar:</p>
                    </div>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-danger <?= $model->hasErrors() ? 'display' : 'display-hide' ?>">
                            <button class="close" data-close="alert"></button>
                            <ul>
                            <?php
                            $errors = $model->getErrors();
                            foreach ($errors as $error) {
                                echo '<li>' . $error[0] . '</li>';
                            }
                            ?>
                                </ul>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control form-control-solid placeholder-no-fix form-group'])->label(false) ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'class' => 'form-control form-control-solid placeholder-no-fix form-group'])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="rem-password">
                            <label class="rememberme mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" name="remember" value="1" /> Recordarme
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-8 text-right">
                        <div class="forgot-password">
                            <a href="javascript:;" id="forget-password" class="forget-password">Restablecer contrase&ntilde;a</a>
                        </div>
                        <?= Html::submitButton('<i class="fa fa-sign-in"></i> Acceder', ['class' => 'btn purple']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form" action="javascript:;" method="post">
                    <h3 class="font-green">Restablecer contrase&ntilde;a</h3>
                    <p>Introduzca su direcci&oacute;n de correo electr&oacute;nico</p>
                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">Regresar</button>
                        <button type="submit" class="btn btn-success uppercase pull-right">Continuar</button>
                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-5 bs-reset">
                        <ul class="login-social">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy; FD <?= date('Y') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="site-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4" style="border: 1px dashed grey; border-radius: 5px; margin-top: 20px;">
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
                        <div class="form-group">

                        </div>

        </div>
    </div>
</div>
-->