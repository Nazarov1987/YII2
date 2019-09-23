<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\db\QueryBuilder;
use app\models\Activity;
use app\models\AddEvent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;

class ActivityController extends Controller{
    /**
     * Настройка поведений контроллера (ACF доступы)
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete', 'submit'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex($sort = false)
    {
        //$query = new Query();
        //$query->select('*')->from('event-tb2');
        $query = AddEvent::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'validatePage' => false,
            ],
        ]);

        return $this->render('index', [
            'provider' => $provider,
        ]);
    }
    public function actionView($id)
    {
          // TODO: просмотр события по GET $id (DetailView)
          $item = AddEvent::findOne($id);
          return $this->render('view', [
              'model' => $item,
          ]);
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
    /**
     * Создание нового события
     *
     * @param int|null $id
     *
     * @return string
     */
    public function actionUpdate(int $id = null)
    {
        // TODO: показ ошибки 404, если нет такой статьи или нет прав на редактирование
        $item = $id ? AddEvent::findOne($id) : new Activity();
        return $this->render('edit', [
            'model' => $item,
        ]);
    }
        /**
     * Удаление выбранного события
     *
     * @param int $id
     *
     * @return string
     */
    public function actionDelete(int $id)
    {
        // TODO: удаление записи по $id + flash Alert, или показ ошибки, если нет прав на редактирование
        AddEvent::deleteAll(['id_event_fd' => $id]);
        return $this->redirect(['activity/index']);
    }
}