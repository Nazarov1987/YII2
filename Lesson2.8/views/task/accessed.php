<?php

use app\models\TaskUser;
use app\models\User;
use Faker\Provider\zh_TW\DateTime;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доступ к задачам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'title',
            'description:ntext',
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
