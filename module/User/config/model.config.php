<?php
return [
    // Objects
    'matryoshka' => [
        'object_manager' => [
        ],
    ],
    'matryoshka-objects' => [ // Object abstract service factory
        'User' => [
            'type'                   => 'User\Model\Entity\UserEntity',
            'active_record_criteria' => 'Matryoshka\Model\Wrapper\Mongo\Criteria\ActiveRecord\ActiveRecordCriteria',
            'hydrator'               => 'User\Model\Hydrator\UserEntityHydrator',
        ],
    ],
    // Models
    'matryoshka-models' => [ // Model abstract service factory
        'User\Model\UserModel' => [
            'datagateway'           => 'Mongo\DataGateway\User',
            'resultset'             => 'Matryoshka\Model\Wrapper\Mongo\ResultSet\HydratingResultSet',
            'paginator_criteria'    => 'Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria',
            'object'                => 'User',
            'hydrator'              => 'User\Model\Hydrator\UserModelHydrator',
            'type'                  => 'User\Model\UserModel'
        ],
    ],

    // Mongo collection
    'mongocollection'    => [
        'Mongo\DataGateway\User' => [
            'database'   => 'DataBase\MongoDb',
            'collection' => 'user'
        ],
    ],
];
