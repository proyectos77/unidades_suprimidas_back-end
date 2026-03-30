<?php

return [

    'default' => env('FILESYSTEM_DISK', 'public'),

    'disks' => [

        // 🔹 LOCAL (storage)
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
        ],

        // 🔥 PRODUCCIÓN (bodega real)
        'bodega' => [
            'driver' => 'local',
            'root' => '/bodega/unidades-suprimidas',
        ],

        // 🔹 SFTP (opcional)
        'sftp_documentos' => [
            'driver' => 'sftp',
            'host' => env('SFTP_HOST'),
            'username' => env('SFTP_USER'),
            'password' => env('SFTP_PASSWORD'),
            'root' => env('SFTP_ROOT'),
            'port' => 22,
            'timeout' => 30,
        ],
    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];


