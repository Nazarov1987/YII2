<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Activity;

class ActivityController extends Controller{

    public function actionActivity()
    {
        return $this->render('activity');
    }
}