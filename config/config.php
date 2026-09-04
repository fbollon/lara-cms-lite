<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    // default layout name of your app to be used
    'layout' => 'layouts.default',

    // DB table name to store contents data
    'table' => 'contents',

    // 'roles' => ['redactor', 'toto'], //to be implemented

    // User specifications in your app
    'user' => [
        'className' => 'User',
        'displayFieldName' => 'username',
    ],

    // to filter routes in select menu in create and edit forms
    'filter_routes' => true,

    // example to limit select menu value filter_routes needs to be true
    'allowed_routes' => [
        'help',
        '/',
        'about',
    ],


    // TinyMCE CDN URL used in the create and edit views
    'tinymce_url' => env(
        'LARA_CMS_LITE_TINYMCE_URL',
        'https://cdn.jsdelivr.net/npm/tinymce@8.9.0/tinymce.min.js'
    ),

    /*
|--------------------------------------------------------------------------
| Bootstrap version
|--------------------------------------------------------------------------
|
| Version of Bootstrap used by the host application.
| Supported versions: 4 and 5.
|
*/

    'bootstrap_version' => (int) env('LARA_CMS_LITE_BOOTSTRAP_VERSION', 5),

];
