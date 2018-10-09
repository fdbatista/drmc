<?php
/* @var $this View */
/* @var $content string */

use backend\assets\FontAwesomeAsset;
use ramosisw\CImaterial\web\MaterialAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/*
  use yii\dependencies
 */
//Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    MaterialAsset::register($this);
}

FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrapper">

            <div class="sidebar" data-color="purple" data-image="<?= Url::to('@web/img/sidebar.jpg') ?>">

                <div class="logo">
                    <a href="<?= Yii::$app->getHomeUrl() ?>" class="simple-text">
                        <i class="material-icons">settings</i> Administraci&oacute;n
                    </a>
                </div>

                <div class="sidebar-wrapper">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        ?>
                        <ul class="nav">
                            <li class="<?= $this->params['active'] === 'dashboard' ? 'active' : '' ?>"><a href="<?= Url::to(['site/dashboard']) ?>"><i class="material-icons">dashboard</i>Panel de control</a></li>
                            <li class="<?= $this->params['active'] === 'brands' ? 'active' : '' ?>"><a href="<?= Url::to(['/brands']) ?>"><i class="material-icons">content_paste</i>Marcas</a></li>
                            <li class="<?= $this->params['active'] === 'countries' ? 'active' : '' ?>"><a href="<?= Url::to(['/countries']) ?>"><i class="material-icons">content_paste</i>Pa&iacute;ses</a></li>
                            <li class="<?= $this->params['active'] === 'device-types' ? 'active' : '' ?>"><a href="<?= Url::to(['/device-types']) ?>"><i class="material-icons">content_paste</i>Tipos de dispositivos</a></li>
                            <li class="<?= $this->params['active'] === 'app-config' ? 'active' : '' ?>"><a href="<?= Url::to(['/settings']) ?>"><i class="material-icons">content_paste</i>Configuraci&oacute;n</a></li>
                            <li class="<?= $this->params['active'] === 'shop' ? 'active' : '' ?>"><a href="<?= Url::to(['/shop']) ?>"><i class="material-icons">content_paste</i>Tienda</a></li>
                            <li class="<?= $this->params['active'] === 'warehouse' ? 'active' : '' ?>"><a href="<?= Url::to(['/warehouse']) ?>"><i class="material-icons">content_paste</i>Almac&eacute;n</a></li>
                            <li class="<?= $this->params['active'] === 'workshop' ? 'active' : '' ?>"><a href="<?= Url::to(['/workshop']) ?>"><i class="material-icons">content_paste</i>Reparaciones</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="main-panel">

                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="navbar-brand" href="">Bienvenido, <?= Yii::$app->user->identity->username ?>.</span>
                        </div>
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            ?>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="material-icons">security</i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="<?= $this->params['active'] === 'users' ? 'active' : '' ?>"><a href="<?= Url::to(['/users']) ?>"><i class="material-icons">content_paste</i> Usuarios</a></li>
                                            <li class="<?= $this->params['active'] === 'roles' ? 'active' : '' ?>"><a href="<?= Url::to(['/roles']) ?>"><i class="material-icons">content_paste</i> Roles</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="material-icons">notifications</i>
                                            <span class="notification">5</span>
                                            <p class="hidden-lg hidden-md">Notifications</p>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Tienes un nuevo correo electr&oacute;nico</a></li>
                                            <li><a href="#">Has adicionado 1 nuevo producto</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="material-icons">person</i>
                                            <p class="hidden-lg hidden-md">Profile</p>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= Url::to(['site/profile']) ?>"><i class="material-icons">account_box</i> Mi Perfil</a></li>
                                            <li><a href="<?= Url::to(['site/logout']) ?>" data-method="post"><i class="material-icons">highlight_off</i> Cerrar Sesi&oacute;n</a></li>
                                        </ul>
                                    </li>
                                </ul>

                                <form class="navbar-form navbar-right" role="search">
                                    <div class="form-group  is-empty">
                                        <input type="text" class="form-control" placeholder="Buscar">
                                        <span class="material-input"></span>
                                    </div>
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                        <i class="material-icons">search</i><div class="ripple-container"></div>
                                    </button>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid" style="padding: 0 20px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <p class="copyright pull-right">
                            &copy; <?= date('Y') ?> <a href="https://www.linkedin.com/profile/felix-daniel-batista">fdbatista</a>, made with love for a better web
                        </p>
                    </div>
                </footer>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
