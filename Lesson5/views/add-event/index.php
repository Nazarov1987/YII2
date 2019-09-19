<?php

use yii\models\AddEvent;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 *  @var \yii\web\View $this
 *  @var \app\models\AddEvent $model
 */

?>

<h2> Добавить новое событие </h2>

<?php $form = ActiveForm::begin([
    'action' => '/add-event/submit',
]) ?>

<?= $form->field($model, 'title_fd')->textInput() ?>
<?= $form->field($model, 'day_start_fd')->textInput(['type' => 'date']) ?>
<?= $form->field($model, 'day_end_fd')->textInput(['type' => 'date']) ?>
<?= $form->field($model, 'user_id_fd')->textInput(['autocomplete' => 'off']) ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'repeat_fd')->checkbox() ?>
<?= $form->field($model, 'blocked_fd')->checkbox() ?>

<div class="form-group" style="margin-left: 500px;">
<?= Html::submitButton('Добавить событие', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end() ?>