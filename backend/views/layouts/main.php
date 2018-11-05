<?php
/* @var $this View */
/* @var $content string */

use backend\assets\FontAwesomeAsset;
use kartik\depdrop\DepDrop;
use ramosisw\CImaterial\web\MaterialAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/*
  use yii\dependencies
 */
//Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    MaterialAsset::register($this);
}
if (!isset($this->params['active'])) {
    $this->params['active'] = 'index';
}
FontAwesomeAsset::register($this);

$this->registerJs('$(document).ready(function () { $(\'body\').tooltip({selector: \'[data-toggle="tooltip"]\'});  $(\'.js-example-basic-single\').select2();  });');
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?= Yii::$app->language ?>" moznomarginboxes mozdisallowselectionprint>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <link href="<?= Url::to('@web/css/print.css') ?>" rel="stylesheet" type="text/css" media="print">
        <link rel="shortcut icon" type=image/png href="<?= Url::to('@web/img/favicon.png') ?>">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrapper">

            <div class="sidebar non-printable" data-color="purple" data-image="<?= Url::to('@web/img/sidebar.jpg') ?>">

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
                            <?php if (Yii::$app->user->can('view-dashboard')) { ?><li class="<?= $this->params['active'] === 'dashboard' ? 'active' : '' ?>"><a href="<?= Url::to(['site/view-dashboard']) ?>"><i class="material-icons">dashboard</i>Panel de control</a></li> <?php } ?>
                            <?php if (Yii::$app->user->can('index-brands')) { ?><li class="<?= $this->params['active'] === 'brands' ? 'active' : '' ?>"><a href="<?= Url::to(['/brands']) ?>"><i class="material-icons">spa</i>Marcas</a></li> <?php } ?>
                            <?php if (Yii::$app->user->can('index-device-types')) { ?><li class="<?= $this->params['active'] === 'device-types' ? 'active' : '' ?>"><a href="<?= Url::to(['/device-types']) ?>"><i class="material-icons">phonelink_setup</i>Tipos de dispositivos</a></li> <?php } ?>
                            <?php if (Yii::$app->user->can('index-shop')) { ?><li class="<?= $this->params['active'] === 'shop' ? 'active' : '' ?>"><a href="<?= Url::to(['/shop']) ?>"><i class="material-icons">shopping_cart</i>Tienda</a></li> <?php } ?>
                            <?php if (Yii::$app->user->can('index-warehouse')) { ?><li class="<?= $this->params['active'] === 'warehouse' ? 'active' : '' ?>"><a href="<?= Url::to(['/warehouse']) ?>"><i class="material-icons">store</i>Almac&eacute;n</a></li> <?php } ?>
                            <?php if (Yii::$app->user->can('index-workshop')) { ?><li class="<?= $this->params['active'] === 'workshop' ? 'active' : '' ?>"><a href="<?= Url::to(['/workshop']) ?>"><i class="material-icons">android</i>Reparaciones</a></li> <?php } ?>
                            <?php if (Yii::$app->user->can('index-sales')) { ?><li class="<?= $this->params['active'] === 'sales' ? 'active' : '' ?>"><a href="<?= Url::to(['/sales']) ?>"><i class="material-icons">attach_money</i>Ventas</a></li> <?php } ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="main-panel">

                <nav class="navbar navbar-transparent navbar-absolute non-printable">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="navbar-brand" href="">Bienvenido, <?= Yii::$app->user->identity->username ?></span>
                        </div>
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            ?>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <?php if (Yii::$app->user->can('index-app-config')) { ?><li class="<?= $this->params['active'] === 'app-config' ? 'active' : '' ?>"><a href="<?= Url::to(['/settings']) ?>"><i class="material-icons">settings</i>Configuraci&oacute;n</a></li> <?php } ?>
                                    <?php if (Yii::$app->user->can('index-users') || Yii::$app->user->can('index-roles')) { ?>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="material-icons">security</i> Seguridad
                                            </a>
                                            <ul class="dropdown-menu">
                                                <?php if (Yii::$app->user->can('index-users')) { ?><li class="<?= $this->params['active'] === 'users' ? 'active' : '' ?>"><a href="<?= Url::to(['/users']) ?>"><i class="material-icons">content_paste</i> Usuarios</a></li> <?php } ?>
                                                <?php if (Yii::$app->user->can('index-roles')) { ?><li class="<?= $this->params['active'] === 'roles' ? 'active' : '' ?>"><a href="<?= Url::to(['/roles']) ?>"><i class="material-icons">content_paste</i> Roles</a></li> <?php } ?>
                                            </ul>
                                        </li> <?php } ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="material-icons">notifications</i>
                                            <span class="notification">0</span>
                                            <p class="hidden-lg hidden-md">Notifications</p>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">No tienes notificaciones nuevas</a></li>
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
                            <div class="col-lg-12 non-printable">
                                <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer non-printable">
                    <div class="container-fluid">
                        <p class="copyright pull-right">
                            &copy; <?= date('Y') ?> <a href="https://www.linkedin.com/profile/felix-daniel-batista">fdbatista</a>
                        </p>
                    </div>
                </footer>
            </div>

            <!--<div class="modal fade" id="modal-pre-diagnosis" tabindex="-1" role="dialog" aria-labelledby="PreDiag" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar componente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <?=
                                    DepDrop::widget([
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'data' => [],
                                        'language' => 'es',
                                        'name' => 'devices-by-brand-list',
                                        'options' => ['placeholder' => 'Seleccione un tipo de dispositivo', 'class' => 'form-control', 'id' => 'devices-by-brand-list'],
                                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                        'pluginOptions' => [
                                            'placeholder' => 'Seleccione un tipo',
                                            'depends' => ['brand_model_id'],
                                            'url' => Url::to(['/workshop/get-warehouse-items-by-brand-model']),
                                        ],
                                        'pluginEvents' => [
                                            "change" => "function() { var currItem = {id: $(this).select2('data')[0].id, name: $(this).select2('data')[0].text}; $('#new-pre-diagnosis-item').val(JSON.stringify(currItem));  }",
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= Html::input('text', 'new-pre-diagnosis-items', null, ['id' => 'new-pre-diagnosis-items', 'class' => 'form-control', 'placeholder' => 'Cantidad']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button onclick="addPreDiagnosisItem()" type="button" class="btn btn-primary">Agregar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
