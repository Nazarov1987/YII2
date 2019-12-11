<?php
return [
    'createProject' => [
        'type' => 2,
        'description' => 'Create a project',
    ],
    'updateProject' => [
        'type' => 2,
        'description' => 'Update project',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'createProject',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'updateProject',
            'user',
        ],
    ],
];
