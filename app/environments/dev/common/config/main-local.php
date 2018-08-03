<?php
return [
    'components' => [
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=ylab-test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
];
