<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">
    <?if($model->img):?>
        <img src="/upload/<?=$model->img?>" class="img-fluid" style="width: 300px;">
    <?endif?>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?if(!$model->ibsn):?>
    <?= $form->field($model, 'ibsn')->textInput() ?>
    <?else:?>
        <label>Артикул:</label>
        <?=$model->ibsn?>
    <?endif?>

    <?= $form->field($model, 'img')->fileInput()?>

    <?= $form->field($model, 'pageCount')->textInput() ?>

    <?= $form->field($model, 'publishedDate')->textInput() ?>


    <?= $form->field($model, 'shortDescription')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
            ],
        ],
    ]); ?>
    <?= $form->field($model, 'longDescription')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
            ],
        ],
    ]); ?>

    <label>Категории</label>
    <? foreach ($model->category as $one):?>
        <?=$one->name?><br>
    <? endforeach;?>



    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
