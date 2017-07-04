<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Manufacturers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php  $model->is_display = isset($model->is_display)?$model->is_display: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_display')->checkbox() ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => 255, 'class'=>'btn btn-rounded']) ?>

    <?php
    if($model->image){
        echo Html::a( Html::img(Yii::getAlias('@uploads').'/manufacturers/'.$model->image, ['width'=>'90'] ), [Yii::getAlias('@uploads').'/manufacturers/'.$model->image], ['class'=>'galery-simple'] )." <br>";
    }
    ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
