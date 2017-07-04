<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BannersCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banners-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

      <?= $form->field($model, 'category_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\Categories::find()->where('is_display =:is_display AND parent_id =:parent_id',[':is_display'=>1, ':parent_id'=>0])->all(), 'id', 'name'), ['id'=>'id']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->dropDownList( Yii::$app->params['banner_position'] ) ?>

    <?php  $model->is_active = isset($model->is_active)?$model->is_active: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php
    if($model->image){
        echo Html::img(Yii::getAlias('@uploads').'/advertising/'.$model->image)." <br>";
    }
    ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
