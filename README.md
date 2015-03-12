Skapp
=======================

Introduction
------------
This is a skeleton application using the ZF2 MVC layer and module
systems.

This application is meant to be used as a **fast start** [ aka _/skapp/_ in out origin dialects ] place for those
looking to get their feet wet with ZF2.

This skeleton uses only composer to install dependencies and for autoloding.

Some usefull dependencies in order to work in a Nginx/Mongo/SphinxSearch environment
are included in composer.json.

Installation
------------

Using Composer
----------------------------
The only way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies:

    composer install


### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.

*Note:* The built-in CLI server is *for development only*.

*Note:* In oreder to decline static file requests back to the PHP built-in webserver, you've to de-comment a code block inside public/index.php

### Nginx Setup

To setup nginx, open your `/path/to/nginx/nginx.conf` and add the [ìnclude directive](http://nginx.org/en/docs/ngx_core_module.html#include) below into `http` block (if doesn't exists):

    http {
        # ...
        include conf.d/*.conf;
    }

Create a virtual host configuration file for your project under `/path/to/nginx/conf.d/project-name.tld.conf`
it should look something like below:


```
server {
        listen                          80;

        server_name                     _;

        access_log                      logs/project-name.access.log;

        proxy_pass_header               Server;
        root                            /var/www/nginx/project-name;
        index                           index.php;

        location ~* \.(eot|ttf|woff)$ {
            add_header                  Access-Control-Allow-Origin *;
            try_files                   $uri $uri/ /index.php$is_args$args;
        }

        location / {
            try_files                   $uri $uri/ /index.php$is_args$args;
        }

        location ~* .php$ {
            fastcgi_pass                unix:/var/www/php/fpm-projectname.sock;
            fastcgi_param               SCRIPT_FILENAME /var/www/nginx/project-name/index.php;
            fastcgi_param               APPLICATION_ENV development;
            include                     fastcgi_params;
        }
}
```
**Note**: This nginx config requires that you have the eot, ttf and woff mime types in your mime.types

Restart the nginx, now you should be ready to go!

### Application setup

1. Install nodejs

2. `npm install -g bower`

3. `npm install -g grunt-cli`

4. `cd module/Application/asset` and execute:

    `npm install`
    `bower install`
    `grunt default`

**Note:** use `grunt watch` to keep js/less files synced in dist directory

To enable development mode
--------------------------

```sh
cd path/to/install
php public/index.php development enable
```

To disable development mode
---------------------------

```sh
cd path/to/install
php public/index.php development disable
```

**Note:** Don't run development mode on your production server.
