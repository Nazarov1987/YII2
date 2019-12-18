<?php
return [
    'createProject' => [
        'type' => 3,
        'description' => 'Create a project',
    ],
    'updateProject' => [
        'type' => 3,
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
