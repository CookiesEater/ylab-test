<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class PopperAsset extends AssetBundle
{
    public $js = [
        [
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
            'integrity' => 'sha256-98vAGjEDGN79TjHkYWVD4s87rvWkdWLHPs5MC3FvFX4=',
            'crossorigin' => 'anonymous',
        ],
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}
