<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'application' => [
        'base_url'  => '/'
    ],
    'assetic_configuration' => [
        'debug'          => true,
        'buildOnRequest' => true,
        'webPath'        => 'public/_/asset',
        'basePath'       => '/_/asset',
    ],
    'sphinxql' => [
        'driver'    => 'pdo_mysql',
        'hostname'  => '127.0.0.1',
        'port'      => 9306,
        'charset'   => 'UTF8'
    ],
    'ga' => [
        'monitoring_id' => 'UA-XXXXXXXX-X',
        'domain'        => 'yourdomain.com'
    ],
    'facebook' => [
        'appId' => '',
    ],
    'session_config' => [
        'name'                  => 'PHPSID',
        'use_cookies'           => true,
        'cookie_domain'         => 'yourdomain.com',
        'cookie_httponly'       => true,
        'cookie_lifetime'       => 2592000, //30 days
        'remember_me_seconds'   => 2592000, //30 days
        'gc_maxlifetime'        => 2592000, //30 days
    ],
    'session_manager' => [
        'enable_default_container_manager' => true,
    ],
    'session_save_handler_mongo' => [
        'hosts'      => '127.0.0.1:27017',
        'database'   => 'yourdatabase',
        'collection' => 'sessions',
    ],
];
