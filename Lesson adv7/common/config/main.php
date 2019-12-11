<?php
use common\services\ProjectService;
use common\services\AssignRoleEvent;
use common\services\EmailService;
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'projectService' => [
            'class' => ProjectService::class,
            'on '.ProjectService::EVENT_ASSIGN_ROLE => function(AssignRoleEvent $event){
                Yii::$app->emailService->send(
                $event->user->email, 'Изменена роль в проекте',
                ['html' => 'assignRole-html', 'text' => 'assignRole-text'],
                ['user' => $event->user, 'project' => $event->project, 'role' => $event->role]
                );
            }
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@console/rbac/items.php',
            'assignmentFile' => '@console/rbac/assignments.php',
        ],
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module',
        ],
    ],
];
