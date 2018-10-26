<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Select2Asset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
        'plugins/select2/select2.css',
    ];
    public $js = [
        'plugins/select2/select2.min.js',
    ];
    public $depends = [
    ];

}
