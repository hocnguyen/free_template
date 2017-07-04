<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-methods-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => 255, 'class'=>'btn btn-rounded']) ?>

    <?php
    if ($model->image) {
        echo Html::img(Yii::getAlias('@uploads').'/payment-method/'.$model->image, ['width'=>'90'] );
    }
    ?>

    <?= $form->field($model, 'configuration')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
