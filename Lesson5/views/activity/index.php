<?php

/**
 *  @var \yii\web\View $this
 *  @var \app\models\Activity[] $event_tb
 *  @var \app\models\Day $day
 */
    use yii\helpers\Html;
?>

    <h1>Календарь событий</h1>

    <ul>
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

    <h3><?= $day->dayOff ?></h3>
    <h3><?= $day->activities ?></h3>

    <div class="form-group pull-right">
        <?= Html::a('Создать', ['add-event/index'], ['class' => 'btn btn-success pull-right']) ?>
    </div>