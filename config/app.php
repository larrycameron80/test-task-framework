<?php

return [
    'db' => [
        'class' => \classes\Db::class,
        'host' => 'localhost',
        'dbname' => 'test',
        'user' => 'root',
        'pass' => '123',
        'character' => 'utf8',
    ],
    'urlResolver' => [
        'class' => \classes\UrlResolver::class,
        'rules' => [
            '/auth/register' => [\controllers\AuthController::class, 'register'],
            '/auth/login' => [\controllers\AuthController::class, 'login'],
            '/auth/logout' => [\controllers\AuthController::class, 'logout'],
        ]
    ],
    'security' => [
        'class' => \classes\Security::class,
        'salt' => '34kj32432^*&&^jhjk',
    ],
    'userRepository' => [
        'class' => \repositories\UserRepository::class,
        'table' => 'users',
        'modelClass' => \models\User::class
    ],
];
