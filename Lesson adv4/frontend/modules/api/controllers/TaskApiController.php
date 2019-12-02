<?php

namespace frontend\modules\api\controllers;

use yii\rest\Controller;
use frontend\modules\api\models\TaskApi;
use yii\data\ActiveDataProvider;

class TaskApiController extends Controller
{
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => TaskApi::find()
        ]);
    }

    public function actionView($id)
    {
        return TaskApi::findOne($id);
    }
}