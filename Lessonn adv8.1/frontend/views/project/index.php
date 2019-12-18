<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
            ['attribute' => 'active',
            'filter' => Project::STATUSES_LABELS,
            'value' => function(Project $model){
                return Project::STATUSES_LABELS[$model -> active];
            },
        ],
            'creator_id:datetime',
            //'updater_id',
            'created_at:datetime',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
