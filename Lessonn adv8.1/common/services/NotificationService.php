<?php

namespace common\services;

use yii\base\Component;
use common\models\Project;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;
use yii\base\Event;
use common\services\EmailServiceInterface;

class NotificationService extends Component
{
    protected $emailService;

    public function __construct(EmailServiceInterface $emailService, array $config = [])
    {
        parent::__construct($config);
        $this->emailService = $emailService;
    }

    public function sendAboutNewProjectRole($user, $project, $role){
        $views = ['html' => 'assignRole-html', 'text' => 'assignRole-text'];
        $data = ['user' => $user, 'project' => $project, 'role' => $role];
        $this->emailService->send($user->email, 'New role '.$role, $views, $data);
    }
}

