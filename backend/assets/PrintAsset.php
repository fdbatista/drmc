<?php

namespace backend\assets;

use yii\web\AssetBundle;
use \Yii;

/**
 * Main backend application asset bundle.
 */
class PrintAsset extends AssetBundle
{
    public $sourcePath = '@app/../common/assets';
    
    public $css = [
    ];
    public $js = [
        'plugins/print/printThis.js',
        //'plugins/print/jQuery.print.min.js',
        'plugins/print/functions.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
