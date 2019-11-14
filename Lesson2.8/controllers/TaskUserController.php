<?php

namespace app\controllers;

use app\models\Task;
use Yii;
use app\models\User;
use app\models\TaskUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * TaskUserController implements the CRUD actions for TaskUser model.
 */
class TaskUserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'deleteAll' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Creates a new TaskUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(int $taskId)
    {
        $model = Task::findOne($taskId);
        if(!$model || $model->creator_id !=Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
        $model = new TaskUser();
        $model -> task_id = $taskId;

        $users = User::find()->
        where(['<>', 'id', Yii::$app->user->id])->
        select('username')->
        indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Задача назначена выбранному пользователю');
            return $this->redirect(['task/my']);
        }
        return $this->render('create', [
            'model' => $model,
            'users' => $users,
        ]);
    }

    /**
     * Deletes an existing TaskUser model.
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
     * Deletes an existing TaskUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteAll(int $taskId)
    {
        $model = Task::findOne($taskId);
        if(!$model || $model->creator_id !=Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
        $model->unlinkAll(Task::RELATION_TASK_USERS, true);
        Yii::$app->session->setFlash('success', 'Связь с выбранным пользователем удалена');

        return $this->redirect(['task/shared']);

    }
    /**
     * Finds the TaskUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
