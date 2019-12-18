<?php

namespace common\services;

use yii\base\Component;
use common\services\EmailServiceInterface;
use Yii;

class EmailService extends Component implements EmailServiceInterface
{
    public function send($to, $subject, $views, $data) : bool
    {
    return Yii::$app->mailer->compose($views, $data)->
    setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']) ->
    setTo($to) -> setSubject($subject) -> send();
    }
}