<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;


class TestController extends Controller{

    public function actionTest()
    {
    return  Yii::$app->test->test();
    }
}