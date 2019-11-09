<?php

use app\models\TaskUser;
use Faker\Provider\zh_TW\DateTime;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            'template' => '{share} {view} {update} {delete}',
            'buttons' => [
                'share' => function($url, \app\models\Task $model, $key){
                    $ico = \yii\bootstrap\Html::icon('share');
                    return HTML::a($ico, ['task-user/create', 'taskId' => $model->id]);
                },
            ],
        ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
