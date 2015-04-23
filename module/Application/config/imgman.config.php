<?php
return [
	'service_manager'       => [
	    'abstract_factories' => [
	         // Load abstract service
	        'ImgMan\Service\ImageServiceAbstractFactory',
	         // Load abstract factory to mongo connection
	        'ImgMan\Storage\Adapter\Mongo\MongoDbAbstractServiceFactory',
	         // Load abstract factory to mongo adapter
	        'ImgMan\Storage\Adapter\Mongo\MongoAdapterAbstractServiceFactory',
	         // Load abstract factory to FileSystem adapter
	        'ImgMan\Storage\Adapter\FileSystem\FileSystemAbstractServiceFactory'
	    ],
	    'factories' => [
	         // Load (operation) helper plugin manager
	        'ImgMan\Operation\HelperPluginManager' => 'ImgMan\Operation\HelperPluginManagerFactory',
	    ],
	    'invokables' => [
	         // Load adapter
	        'ImgMan\Adapter\Imagick' => 'ImgMan\Core\Adapter\ImagickAdapter',
	    ],
	],    
    
    'imgman_mongodb' => [
        'MongoDb' => [
            'database' => 'skapp'
        ]
    ],
    'imgman_adapter_mongo' => [
        'ImgMan\Storage\Mongo' => [
            'collection' => 'images',
            'database' => 'MongoDb'
        ]
    ],
    
    'imgman_services' => [
        'ImgMan\Service\Default' => [
            'adapter' => 'ImgMan\Adapter\Imagick',
            'storage' => 'ImgMan\Storage\Mongo',
            'helper_manager' => 'ImgMan\Operation\HelperPluginManager',
            'renditions' => [
                'thumb' => [
                    'resize' => [
                        'width'  => 200,
                        'height' => 200,
                    ],
                    'compression' => [
                        'compression' => 90,
                        'compressionQuality' => 70,
                    ]
                ],
                'thumbmaxi' => [
                    'resize' => [
                        'width'  => 400,
                        'height' => 400,
                    ],
                ],
            ],
        ],
    ],    

    'cdn' => [
		'local' => [
			'placeholder_url' => 'http://placehold.it/150x150'	
		]
	]
    
];