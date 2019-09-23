<?php
/**
 * @var $this yii\web\View
 * @var $model \app\models\Activity
 * @var $item app\models\AddEvent
 */
use yii\helpers\Html;
?>
<div class="row">
    <h1><?= Html::encode($item->title ?: 'Новое событие') ?></h1>

    <div class="form-group pull-right">
        <?= Html::a('Отмена', ['activity/view', 'id' => $item->id], ['class' => 'btn btn-info']) ?>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $item,
]) ?>