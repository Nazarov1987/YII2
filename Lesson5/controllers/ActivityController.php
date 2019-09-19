<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\db\QueryBuilder;
use app\models\Activity;
use app\models\AddEvent;
use yii\web\Controller;

class ActivityController extends Controller{
    public function actionIndex($sort = false)
    {
        //$query = new Query();
        //$query->select('*')->from('event-tb2');
        $query = AddEvent::find();
        if ($sort) {
            $query->orderBy("id desc");
        }
        $rows = $query->all();
        return $this->render('index', [
            'event_tb' => $rows
        ]);
    }
    public function actionView($id)
    {
        $db = Yii::$app->db;
        $model = $db->createCommand('select * from event-tb2 where id=:id', [
            ':id' => $id,
        ])->queryOne();
        return $this->render(
            'view',
            compact('model')
        );
    }
    public function actionCreate()
    {
        //создание
        $model = new Activity();
        return $this->render(
            'create',
            compact('model')
        );
    }
}