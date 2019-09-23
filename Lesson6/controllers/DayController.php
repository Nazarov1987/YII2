<?php

namespace app\controllers;

use app\models\Day;
use yii\web\Controller;

class DayController extends Controller
{
    public function actionIndex()
    {
        $activityDay = new Day();

        return $this->render('index', [
            'day'=> $activityDay
        ]);
    }
}