<?php

return [
    'home' => [
        'controller' => 'home',
        'action' => 'users',
    ],
    'user' => [
        'controller' => 'user',
        'action' => 'index',
    ],
    'company' => [
        'controller' => 'home',
        'action' => 'company',
    ],

    'auth' => [
    'controller' => 'user',
    'action' => 'auth',
    ],
    'reg' => [
    'controller' => 'user',
    'action' => 'reg',
    ],
    'out' => [
    'controller' => 'user',
    'action' => 'out',
    ],
];
