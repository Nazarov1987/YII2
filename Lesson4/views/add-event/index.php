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

<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'dayStart')->textInput(['type' => 'date']) ?>
<?= $form->field($model, 'dayEnd')->textInput(['type' => 'date']) ?>
<?= $form->field($model, 'userId')->textInput(['autocomplete' => 'off']) ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'repeat')->checkbox() ?>
<?= $form->field($model, 'blocked')->checkbox() ?>

<div class="form-group" style="margin-left: 500px;">
<?= Html::submitButton('Добавить событие', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end() ?>