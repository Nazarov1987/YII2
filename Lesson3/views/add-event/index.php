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
<?= $form->field($model, 'dayStart')->textInput() ?>
<?= $form->field($model, 'dayEnd')->textInput() ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'repeat')->checkbox() ?>
<?= $form->field($model, 'blocked')->checkbox() ?>

<?= Html::submitButton('Добавить событие', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>