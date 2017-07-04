<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\SystemInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-information-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'technical')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'modules')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'next_upgrade')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
