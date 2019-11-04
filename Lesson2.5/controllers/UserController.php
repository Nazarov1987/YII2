<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTestOne() 
    //а) Создаем запись в таблице user.
    {
        $user = new User();
        $user -> setAttributes(
            [
        'username' => 'admin',
        'name' => 'First',
        'password_hash' => 'dfjgukihldydtg',
        'access_token' => 'hjkl;',
        'auth_key' => 'asdfg',
        'creator_id' => 1,
        'updater_id' => 1,
        'created_at' => time(),
        'updated_at' => time(),
            ]
            );
            $user->save();
    _end($user);
    }

    public function actionTestFour()
 //б) Создаем связанную (с записью в user) запиcь в task, используя метод link().
    {
        $user = User::findOne(1);
        $task = new Task();
        $task -> setAttributes(
            [
        'title' => 'Учеба веб-программированию',
        'description' => 'Очередное занятие',
        'created_at' => time(),
            ]
            );
        $task->link('creator', $user);
        _end($task);
    }

    public function actionTestTwo()
 //в) Читаем из базы все записи из User применив жадную подгрузку связанных данных из Task,
 //с запросами без JOIN.
    {
        $user = User::findOne(1);
        _end($user->createdTask);
    }

    public function actionTestThree()
    //г) Читаем из базы все записи из User применив жадную подгрузку связанных данных из Task,
    // с запросом содержащим JOIN.
    {
        $user = User::find()->joinWith(User::RELATION_CREATED_TASK)->all();
        _end($user);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
