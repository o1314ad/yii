<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

?>

<div class="message-form row">
    <div class="col-xl-8 offset-xl-2">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'message')->textArea() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'captcha')->widget(Captcha::className(), ['captchaAction'=>'/message/captcha']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>
