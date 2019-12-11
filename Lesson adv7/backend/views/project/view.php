<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Project;
use common\models\Task;
/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            ['attribute' => 'active',
            'filter' => Project::STATUSES_LABELS,
            'value' => function(Project $model){
                return Project::STATUSES_LABELS[$model -> active];
            }],
            ['label' => 'Пользователи',
            'value' => function(Project $model){
                $role = $model->getUsers()->select('role')->column();
                return join(', ', $role);
            }],
            'creator_id',
            'updater_id',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
