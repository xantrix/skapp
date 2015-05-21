<?php
return [
    'bjyauthorize' => [
        'resource_providers' => [
            \BjyAuthorize\Provider\Resource\Config::class => [
                'User' => [],
            ],
        ],
        'rule_providers' => [
            \BjyAuthorize\Provider\Rule\Config::class => [
                'allow' => [
                    [['user'], 'User', 'edit', 'assertion.CheckMyProfile'], //edit their own profile only
                    [['admin'], 'User', 'edit'], //edit all profiles
                    [['admin'], 'User', 'edit-roles'],
                ],
                'deny' => [
                    // ...
                ],
            ],
        ],
        'guards' => [
            \BjyAuthorize\Guard\Route::class => [
                //Guest
                ['route' => 'application/default', 'roles' => ['guest']],
                ['route' => 'home', 'roles' => ['guest']],
                ['route' => 'images', 'roles' => ['guest']],
                ['route' => 'login', 'roles' => ['guest']],
                ['route' => 'registration', 'roles' => ['guest']],
                ['route' => 'user/recover-password', 'roles' => ['guest']],
                ['route' => 'user/profile', 'roles' => ['guest']],
                //User
                ['route' => 'user-home', 'roles' => ['user']],
                ['route' => 'user/logout', 'roles' => ['user']],
                ['route' => 'user/profile-edit', 'roles' => ['user']], // + rule_providers assertion
                //Admin
                ['route' => 'user/admin', 'roles' => ['admin']],
                ['route' => 'user/list', 'roles' => ['admin']],
            ],	
		]        	
	]
];
    