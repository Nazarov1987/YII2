<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use mohorev\file\UploadImageBehavior;

/* @var $this yii\web\View
*/
/* @var $model common\models\User */
/* @var $form \yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(
        [
            'options' => ['enctype' => 'multipart/form-data'],
            'layout' => 'horizontal',
        ]
    ); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(User::STATUSES_LABELS) ?>

    <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*'])->
label('Avatar<br>' . Html::img($model->getThumbUploadUrl('avatar', User::AVATAR_PREVIEW))) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
