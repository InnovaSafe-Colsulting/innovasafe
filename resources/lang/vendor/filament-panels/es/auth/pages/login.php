<?php

return [

    'title' => 'Iniciar sesión',

    'heading' => 'Iniciar sesión',

    'form' => [

        'email' => [
            'label' => 'Correo',
        ],

        'password' => [
            'label' => 'Contraseña',
        ],

        'remember' => [
            'label' => 'Recuérdame',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Ingresar',
            ],

        ],

    ],

    'messages' => [

        'failed' => 'Las credenciales no coinciden con nuestros registros.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Demasiados intentos',
            'body' => 'Por favor intenta de nuevo en :seconds segundos.',
        ],

    ],

];
