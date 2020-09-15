<?php

return[

    /*
    |--------------------------------------------------------------------------
    | Default resource type
    |--------------------------------------------------------------------------
    */

    'default' => 'module',

    /*
    |--------------------------------------------------------------------------
    | Library´s scanner
    |--------------------------------------------------------------------------
    */

    'scanner' => [
        'filename' => 'apply.json',
        'folder' => base_path('common'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Library´s cache
    |--------------------------------------------------------------------------
    */

    'cache' => [
        'enable' => false,
        'key' => 'apply.library.resources',
    ],

    /*
      |--------------------------------------------------------------------------
      | Library´s factory
      |--------------------------------------------------------------------------
      |
      | Rule supported: "slug", "studly", recommended "slug",
      |
      */

    'factory' => [
        'name' => [
            'rule' => 'slug',
        ],
        'folder' => [
            'rule' => 'slug',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Library plugins assets url  http://domain.com/library/collection:resource/logo.png | css/styles.css | js/scripts.js
    |--------------------------------------------------------------------------
    */

    'assets' => [
        'domain' => 'library.domain.com',
        'name' => 'library.assets',
        'route' => '/library/{alias}/{patch}',
        'controller' =>  Aplify\Library\Support\Controllers\Assets::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Resources Stubs
    |--------------------------------------------------------------------------
    |
    | Default resources stubs.
    |
    */

    'stubs' => [
        'path' => realpath(LIBRARY_PATH.'/stubs/resource'),
        'files'  => [
            'apply'                 => 'apply.json',
            'license'               => 'LICENCE.md',
            'composer'              => 'composer.json',
            'ApplyServiceProvider'  => 'src/Providers/ApplyServiceProvider.php',
            'RouteServiceProvider'  => 'src/Providers/RouteServiceProvider.php',
            'AppServiceProvider'    => 'src/Providers/AppServiceProvider.php',
            //'Controller'            => 'src/Http/Controllers/Controller.php',
        ],
    ],
];