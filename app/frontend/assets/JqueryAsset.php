<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
    public $js = [
        [
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            'integrity' => 'sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=',
            'crossorigin' => 'anonymous',
        ],
    ];
}
