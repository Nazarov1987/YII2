<?php

namespace app\controllers;

use app\models\Day;
use yii\web\Controller;

class DayController extends Controller
{
    public function actionView()
    {
        $activityDay = new Day();

        return $this->render('view', [
            'day'=> $activityDay
        ]);
    }
}