<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $depends = [
        BootstrapAsset::class,
    ];
}
