<?php

/*return [
    'username' => env('VONAGE_USERNAME'),
    'password' => env('VONAGE_PASSWORD'),
];*/

return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vonage Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like. Note that the 3 supported authentication methods are:
    | "application", "password", and "token".
    |
    */

    'connections' => [

        'main' => [
            'username' => env('VONAGE_USERNAME'),
            'password' => env('VONAGE_PASSWORD'),
            'method'   => 'password'
        ],
        'HarryF' => [
            'username' => 'HarryF',
            'password' => 'tG==F6;8bK',
            'method'   => 'password'
        ],
        'tthome' => [
            'username' => 'tthome',
            'password' => '',
            'method'   => 'password'
        ],
        'ChadRoeder' => [
            'username' => 'ChadRoeder',
            'password' => 'j=b183r=!E',
            'method'   => 'password'
        ],
        'BillOfc' => [
            'username' => 'BillOfc',
            'password' => 'Y@Q8;$w3h$',
            'method'   => 'password'
        ],
        'SusanY' => [
            'username' => 'SusanY',
            'password' => 'wY$1p7dBen',
            'method'   => 'password'
        ],
        'AlbreeB' => [
            'username' => 'AlbreeB',
            'password' => 'YTz@41!h$!',
            'method'   => 'password'
        ],
        'bobfridley' => [
            'username' => 'bobfridley',
            'password' => '5X1;RhT202',
            'method'   => 'password'
        ],
        'TaylorC' => [
            'username' => 'TaylorC',
            'password' => 'n;YG=x303=',
            'method'   => 'password'
        ],
        'MeganHill' => [
            'username' => 'MeganHill',
            'password' => 'S=C0bWmD;y',
            'method'   => 'password'
        ],
    ],
];