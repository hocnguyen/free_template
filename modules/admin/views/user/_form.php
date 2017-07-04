<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'password_hash')->passwordInput() ?>
     <?php } ?>   

    <?= $form->field($model, 'image')->fileInput(['maxlength' => 255, 'class'=>' btn btn-primary']) ?>

    <?php
    if($model->image) { ?>
        <img style='border-radius: 50%; background:url(/<?= $model->image ?>); background-size:cover;background-position: center; width:64px;' src='<?= Yii::getAlias('@back') ?>/img/blank.gif'>
    <?php }
    ?>

    <?= $form->field($model, 'status')->textInput()->dropDownList(Yii::$app->params['status_user']) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
