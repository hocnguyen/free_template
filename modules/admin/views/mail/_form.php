<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Mail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['rows' => 6]) ?>

    <?php  $model->is_status = isset($model->is_status)?$model->is_status: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_status')->checkbox() ?>

    <?= $form->field($model, 'subject')->textInput(['rows' => 6]) ?>

     <?= $form->field($model, 'mail_body')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'full'
    ]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
