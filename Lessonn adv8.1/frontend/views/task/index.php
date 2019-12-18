<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'project_id',
            'executor_id',
            'started_at',
            //'completed_at',
            'creator_id',
            //'updater_id',
            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {take}',
            'buttons' => [
                'take' => function($url, \common\models\Task $model, $key){
                    $ico = \yii\bootstrap\Html::icon('hand-right');
                    return HTML::a($ico, ['task/take', 'id' => $model->id], ['data' =>
                    [   'confirm' => 'Берете задачу?',
                        'method' => 'post',
                    ],]);
                },
            ],
            'visibleButtons' => [
                'update' =>
                function (\common\models\Task $model, $key, $index){
                    return Yii::$app->projectService->hasRole($model->projects, Yii::$app->user->identity,
                    \common\models\ProjectUser::ROLE_MANAGER);
                },

                'delete' =>
                function (\common\models\Task $model, $key, $index){
                    return Yii::$app->projectService->hasRole($model->projects, Yii::$app->user->identity,
                    \common\models\ProjectUser::ROLE_MANAGER);
                },

                'take' =>
                function (\common\models\Task $model, $key, $index){
                    return Yii::$app->projectService->hasRole($model->projects, Yii::$app->user->identity,
                    \common\models\ProjectUser::ROLE_DEVELOPER);
                },
            ]
        ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
