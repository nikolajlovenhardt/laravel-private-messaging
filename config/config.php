<?php

return [
    'mappers' => [
        'conversationMapper' => LaravelPM\Mappers\DoctrineORM\ConversationMapper::class,
        'messageMapper' => LaravelPM\Mappers\DoctrineORM\MessageMapper::class,
        'userMapper' => LaravelPM\Mappers\DoctrineORM\UserMapper::class,
    ],

    'models' => [
        'user' => null,
        'conversation' => LaravelPM\Models\Conversation::class,
        'message' => LaravelPM\Models\Message::class,
        'participant' => LaravelPM\Models\Participant::class,
    ],
];
