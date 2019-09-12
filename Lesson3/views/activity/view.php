<?php

/**
 *  @var \yii\web\View $this
 *  @var \app\models\Activity $model
 *  @var \app\models\Day $day
 */

?>

<h1>Календарь событий</h1>

<h2><?= $model->title ?></h2>

<?php if($model->dayStart == $model->dayEnd): ?>
    <h3>Событие на <?=date("d.m.Y", $model->dayStart)?></h3>
<?php else: ?>
    <h3>Событие c <?=date("d.m.Y", $model->dayStart)?> по <?=date("d.m.Y", $model->dayEnd)?></h3>
<?php endif; ?>

<h2><?= $model->description ?></h2>

<h3><?= $model->repeat ?></h3>

<h3><?= $day->dayOff ?></h3>

<h3><?= $day->activities ?></h3>