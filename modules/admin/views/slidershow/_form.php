<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Slidershow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slidershow-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php
    if($model->image){
        echo Html::a( Html::img(Yii::getAlias('@uploads').'/slidershow/'.$model->image, ['width'=>'90'] ), [Yii::getAlias('@uploads').'/slidershow/'.$model->image], ['class'=>'galery-simple'] )." <br>";
    }
    ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
