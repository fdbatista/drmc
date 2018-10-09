<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FontAwesomeAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    
    public $css = [
        'css/font-awesome/css/all.min.css',
        'css/material-icons/material-icons.css',
    ];
    
    public $depends = [
        'backend\assets\AppAsset'
    ];

}
