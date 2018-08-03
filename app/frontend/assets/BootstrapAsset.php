<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $css = [
        [
            'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css',
            'integrity' => 'sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=',
            'crossorigin' => 'anonymous',
        ],
    ];
}
