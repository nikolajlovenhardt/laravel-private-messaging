<?php

return [
    'userModel' => '',

    'mappers' => [
        'messageMapper' => LaravelPM\Mappers\DoctrineORM\MessageMapper::class,
        'userMapper' => LaravelPM\Mappers\DoctrineORM\UserMapper::class,
    ],
];
