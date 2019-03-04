<?php

namespace backend\assets;

use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@app/../common/assets';
	
    public $css = [
        'plugins/datetimepicker/jquery.datetimepicker.css',
    ];
    public $js = [
        'plugins/datetimepicker/jquery.datetimepicker.full.min.js',
        'plugins/datetimepicker/init_date.js',
    ];
    public $depends = [
        //'yii\web\jQueryAsset'
    ];
}
