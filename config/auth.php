<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Model\User\Admin::class,
    ],
    'operator' => [
        'driver' => 'eloquent',
        'model' => App\Model\User\Operator::class,
    ],
    'mahasiswa' => [
        'driver' => 'eloquent',
        'model' => App\Model\User\Mahasiswa::class,
    ],
    'wakildekan' => [
        'driver' => 'eloquent',
        'model' => App\Model\User\WakilDekan::class,
    ],
    'dosen' => [
        'driver' => 'eloquent',
        'model' => App\Model\User\Dosen::class,
    ],

    'guards' => [
            'web' => [
                'driver' => 'session',
                'provider' => 'users',
            ],
            'operator' => [
                'driver' => 'session',
                'provider' => 'operator',
            ],
            'mahasiswa' => [
                'driver' => 'session',
                'provider' => 'mahasiswa',
            ],
            'admin' => [
                'driver' => 'session',
                'provider' => 'admins',
            ],
            'wakildekan' => [
                'driver' => 'session',
                'provider' => 'wakildekan',
            ],
            'dosen' => [
                'driver' => 'session',
                'provider' => 'dosen',
            ],
    ],


    'providers' => [
            'users' => [
                'driver' => 'eloquent',
                'model' => App\Model\User\User::class,
            ],
           'admins' => [
                'driver' => 'eloquent',
                'model' => App\Model\User\Admin::class,
            ],
            'mahasiswa' => [
                'driver' => 'eloquent',
                'model' => App\Model\User\Mahasiswa::class,
            ],
            'operator' => [
                'driver' => 'eloquent',
                'model' => App\Model\User\Operator::class,
            ],
            'wakildekan' => [
                'driver' => 'eloquent',
                'model' => App\Model\User\WakilDekan::class,
            ],
            'dosen' => [
                'driver' => 'eloquent',
                'model' => App\Model\User\Dosen::class,
            ],
    ],


    'passwords' => [
            'users' => [
                'provider' => 'users',
                'table' => 'password_resets',
                'expire' => 60,
            ],
            'admins' => [
                'provider' => 'admins',
                'table' => 'password_resets',
                'expire' => 15,
            ],
            'operator' => [
                'provider' => 'operator',
                'table' => 'password_resets',
                'expire' => 15,
            ],
            'mahasiswa' => [
                'provider' => 'mahasiswa',
                'table' => 'password_resets',
                'expire' => 15,
            ],
            'wakildekan' => [
                'provider' => 'wakildekan',
                'table' => 'password_resets',
                'expire' => 15,
            ],
            'dosen' => [
                'provider' => 'dosen',
                'table' => 'password_resets',
                'expire' => 15,
            ],
    ],

];
