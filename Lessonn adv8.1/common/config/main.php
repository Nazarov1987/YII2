<?php
use common\services\ProjectService;
use common\services\AssignRoleEvent;
use common\services\EmailService;
use common\services\NotificationService;
use common\services\EmailServiceInterface;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'container' => [
        'definitions' => [
        'yii\widgets\LinkPager' => ['maxButtonCount' => 5],
        EmailServiceInterface::class => EmailService::class
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
                // ...
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'notificationService' => [
            'class' => NotificationService::class,
        ],
        'projectService' => [
            'class' => ProjectService::class,
            'on '.ProjectService::EVENT_ASSIGN_ROLE => function(AssignRoleEvent $e){
                Yii::$app -> notificationService->sendAboutNewProjectRole($e->user, $e->project, $e->role);
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
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ],
];
