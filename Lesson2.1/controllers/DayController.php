<?php

namespace app\controllers;

use app\models\Day;
use yii\web\Controller;

class DayController extends Controller
{
    public function actionView()
    {
        $activityDay = new Day();

        $activityDay->weekDay = 'Понедельник';
        $activityDay->haveActivity = 'Других событий нет';
        return $this->render('view', [
            'day'=> $activityDay
        ]);
    }
}