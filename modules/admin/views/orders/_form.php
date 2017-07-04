<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\User::find()->where('role =:role AND status =:status',[':role'=>10, ':status'=>10])->all(), 'id', 'username'), ['id'=>'id']) ?>

    

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'status_id')->dropDownList(\app\models\OrderStatus::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
