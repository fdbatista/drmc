<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'login-assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'login-assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'login-assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'login-assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'login-assets/global/plugins/select2/css/select2.min.css',
        'login-assets/global/plugins/select2/css/select2-bootstrap.min.css',
        'login-assets/global/css/components-md.min.css',
        'login-assets/global/css/plugins-md.min.css',
        'login-assets/pages/css/login-5.css',
    ];
    public $js = [
        'login-assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'login-assets/global/plugins/js.cookie.min.js',
        'login-assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'login-assets/global/plugins/jquery.blockui.min.js',
        'login-assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'login-assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'login-assets/global/plugins/jquery-validation/js/additional-methods.min.js',
        'login-assets/global/plugins/select2/js/select2.full.min.js',
        'login-assets/global/plugins/backstretch/jquery.backstretch.min.js',
        'login-assets/global/scripts/app.js',
        'login-assets/pages/scripts/login-5.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
