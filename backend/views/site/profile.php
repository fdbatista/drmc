<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model User */

$this->title = 'Mi perfil';
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Mi Perfil</h4>
                        <p class="category">Complete el siguiente formulario</p>
                    </div>
                    <div class="card-content">
                        <form>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Company (disabled)</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Username</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email address</label>
                                        <input type="email" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Fist Name</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Adress</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Postal Code</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <div class="form-group label-floating">
                                            <label class="control-label"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                                            <textarea class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="#pablo">
                            <?= Html::img('@web/img/' . ($model->sex === 'F' ? 'fe' : '') . 'male.png', ['class' => 'img']) ?>
                        </a>
                    </div>

                    <div class="content">
                        <h6 class="category text-gray">MI ROL</h6>
                        <h4 class="card-title">Mi nombre</h4>
                        <p class="card-content">
                            Descripci&oacute;n de mi rol
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
