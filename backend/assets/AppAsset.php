<?php

namespace backend\assets;

use yii\web\AssetBundle;
use \Yii;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/../common/assets';
    
    public $css = [
        'css/common.css',
        'css/backend.css',
        'css/material-icons/material-icons.css',
    ];
    public $js = [
        'js/material-demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
