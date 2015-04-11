<?php
return [
    // Objects
    'matryoshka' => [
        'object_manager' => [
        ],
    ],
    'matryoshka-objects' => [ // Object abstract service factory
        'Item' => [
            'type'                   => 'Application\Model\Entity\ItemEntity',
            'active_record_criteria' => 'Matryoshka\Model\Wrapper\Mongo\Criteria\ActiveRecord\ActiveRecordCriteria',
            'hydrator'               => 'Application\Model\Hydrator\ItemEntityHydrator',
        ],
    ],
    // Models
    'matryoshka-models' => [ // Model abstract service factory
        'Application\Model\ItemModel' => [
            'datagateway'           => 'Mongo\DataGateway\Item',
            'resultset'             => 'Matryoshka\Model\Wrapper\Mongo\ResultSet\HydratingResultSet',
            'paginator_criteria'    => 'Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria',
            'object'                => 'Item',
            'hydrator'              => 'Application\Model\Hydrator\ItemModelHydrator',
            'type'                  => 'Application\Model\ItemModel'
        ],
    ],

    // Mongo collection
    'mongocollection'    => [
        'Mongo\DataGateway\Item' => [
            'database'   => 'DataBase\MongoDb',
            'collection' => 'item'
        ],
    ],
];
