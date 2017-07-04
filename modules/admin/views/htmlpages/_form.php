<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\HtmlPages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="html-pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pagecode')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'page_title')->textInput(['maxlength' => 250]) ?>

    <?php  $model->is_status = isset($model->is_status)?$model->is_status: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_status')->checkbox() ?>

    <?= $form->field($model, 'page_text')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
