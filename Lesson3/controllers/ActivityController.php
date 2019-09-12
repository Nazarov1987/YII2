<?php

namespace app\controllers;

use app\models\Activity;
use yii\web\Controller;

class ActivityController extends Controller{
    public function actionIndex()
    {
        return 'Ok';
    }
    public function actionView()
    {
        $activityItem = new Activity();

        $activityItem->title = 'Обучение веб-программированию';
        $activityItem->dayStart = '07.09.2019';
        $activityItem->dayEnd = '09.09.2019';
        $activityItem->userId = 'ID автора';
        $activityItem->description = 'Выполнение домашнего задания';
        $activityItem->repeat = false;
        $activityItem->blocked = true;
        return $this->render('view', [
            'model'=> $activityItem
        ]);
    }
    public function actionCreate()
    {
        //создание
    }
}