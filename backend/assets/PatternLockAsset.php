<?php

namespace backend\assets;

use yii\web\AssetBundle;

class PatternLockAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
        'plugins/pattern-lock/patternLock.css',
    ];
    public $js = [
        'plugins/pattern-lock/patternLock.js',
        'plugins/pattern-lock/init.js',
    ];
    public $depends = [
        'backend\assets\GifEncoderAsset',
    ];

}
