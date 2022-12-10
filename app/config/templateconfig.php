<?php

return [
    'template' => [
        'wrapper_start'     => TEMPLATE_PATH . 'wrapperstart.php',
        'header'            => TEMPLATE_PATH . 'header.php',
        'nav'               => TEMPLATE_PATH . 'nav.php',
        ':view'             => ':action.view',
        'wrapper_end'       => TEMPLATE_PATH . 'wrapperend.php',
    ],
    'header_resources' => [
        'css' => [
            'normalize'     => CSS . 'normalize.css',
            'fawsome'     => CSS . 'fawsome.min.css',
            'googleicons'     => CSS . 'googleicons.css',
            'main'     => CSS . 'main.css',
            'mainar'     => CSS . 'mainar.css',
            'jquery-ui'     => CSS . 'jquery-ui.min.css',
        ],
        'js' => [
            'modernizr'     => JS . 'vendor/modernizr-2.8.3.min.js',
        ],

    ],
    'footer_resources' => [
        'jquery'     => JS . 'vendor/jquery-1.12.0.min.js',
        'datatablesar'     => JS . 'datatablesar.js',
        'datatablesen'     => JS . 'datatablesen.js',
        'main'     => JS . 'main.js',
        'helper'     => JS . 'helper.js',
    ]
];

