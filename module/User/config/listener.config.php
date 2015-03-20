<?php
return [
    'service_manager'    => [
        'factories' => [

        ],
        'invokables' => [
            'User\Model\Listener\RegistrationListener' => 'User\Model\Listener\RegistrationListener',
        ]
    ],

    'matryoshka-models' => [ // TODO: is the model.config.php a better place?
        'User\Model\UserModel' => [
            'listeners' => [
                'User\Model\Listener\RegistrationListener'
            ]
        ],
    ],
];
