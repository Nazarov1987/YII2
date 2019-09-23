<?php

/**
 *  @var $this \yii\web\View
 *  @var $provider \app\models\ActiveDataProvider
 *  @var $item app\models\AddEvent
 */

use app\models\AddEvent;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

/**
     *    <ul>
<?php foreach ($event_tb as $item) { ?>
    <li><strong>Название события: </strong><?= $item->title_fd ?></li>
    <li><strong>Описание события: </strong><?= $item->description ?></li>
    <li><strong>Повтор: </strong><?= $item->repeat_fd ?></li>
    <li><strong>Блокирующее: </strong><?= $item->blocked_fd ?></li>
    <li><strong>Начало: </strong><?= $item->day_start_fd ?></li>
    <li><strong>Окончание: </strong><?= $item->day_end_fd ?></li>
    <br>
<?php } ?>
</ul>
     */
?>

    <h1>Календарь событий</h1>
    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            [
                'class' => SerialColumn::class,
                'header' => 'Порядковый номер',
            ],
            'title_fd',
            'day_start_fd',
            'day_end_fd',
            'user_id_fd',
            //['label' => 'Пользователь',
            //'attribute' => 'user_id',//авто-подключение зависимостей
        //],
            'description',
            'repeat_fd:boolean',
            'blocked_fd:boolean',
            [
                'class' => ActionColumn::class,
                'header' => 'Операции']
        ],
    ]) ?>

    <div class="form-group pull-right">
        <?= Html::a('Создать', ['add-event/index'], ['class' => 'btn btn-success pull-right']) ?>
    </div>