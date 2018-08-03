<?php

return [
    'bootstrap' => ['debug', 'gii'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
    'modules' => [
        'debug' => [
            'class' => yii\debug\Module::class,
        ],
        'gii' => [
            'class' => yii\gii\Module::class,
        ],
    ],
];
