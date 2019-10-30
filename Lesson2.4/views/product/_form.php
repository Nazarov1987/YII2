<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->hint('Введите имя товара')->dropDownList(['111'=>'111','222'=>'222','333'=>'333',]) ?>

    <?= $form->field($model, 'price')->hint('Введите цену товара')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->hint('Введите дату создания товара')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
