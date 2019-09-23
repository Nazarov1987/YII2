<?php
/**
 * @var $this yii\web\View
 * @var $model Activity
 */
use app\models\Activity;
use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<div class="row">
        <h1>Просмотр события</h1>

        <div class="form-group pull-right">
            <?= Html::a('К списку', ['activity/index'], ['class' => 'btn btn-info']) ?>
           
        </div>
    </div>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
            'title_fd',
            'day_start_fd',
            'day_end_fd',
            'user_id_fd',
            //['label' => 'Пользователь',
            //'attribute' => 'user.username',],
            'description',
            'repeat_fd:boolean',
            'blocked_fd:boolean',
        ],
    ]) ?>
