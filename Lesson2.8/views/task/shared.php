<?php

use app\models\TaskUser;
use Faker\Provider\zh_TW\DateTime;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи совместно с другими пользователями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            ['label' => 'Users',
            'value' => function(\app\models\Task $model){
                $ids = $model->getTaskUsers()->select('user_id')->column();
                return join(', ', $ids);
            }],
            'description:ntext',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{unshareAll} {view}',
            'buttons' => [
                'unshareAll' => function($url, \app\models\Task $model, $key){
                    $ico = \yii\bootstrap\Html::icon('remove');
                    return HTML::a($ico, ['task-user/delete-all', 'taskId' => $model->id], [
                        'data' => [
                            'confirm' => 'Вы действительно хотите удалить данную связь?',
                            'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>