<?php

/**
 *  @var \yii\web\View $this
 *  @var \app\models\Activity $model
 *  @var \app\models\Day $day
 */
    use yii\helpers\Html;
?>

    <h1>Календарь событий</h1>

    <p><?= Html::encode($model->description) ?></p>
    <ul>
<?php foreach ($event_tb as $item) { ?>
    <li>
        <?= var_dump($item); ?>
    </li>
<?php } ?>
</ul>

    <h3><?= $day->dayOff ?></h3>
    <h3><?= $day->activities ?></h3>

    <div class="form-group pull-right">
        <?= Html::a('Создать', ['add-event/index'], ['class' => 'btn btn-success pull-right']) ?>
    </div>