<?php

namespace app\controllers;

use app\models\AddEvent;
use Yii;
use yii\web\Controller;

class AddEventController extends Controller{
    public function actionIndex()
    {
        // показать форму
        $model = new AddEvent;
        return $this->render('index', [
            'model'=> $model
        ]);
    }
    public function actionSubmit()
    {
        // принимать данные из формы
        $model = new AddEvent;
        $model -> load(Yii::$app->request->post());

        if($model->validate()){
            return $this->redirect('/add-event/result');
        }else{
            return 'Возникла ошибка при добавлении события';
        }
    }
        public function actionResult()
    {
        // исход операции
        return 'Событие добавлено в календарь';
    }
}