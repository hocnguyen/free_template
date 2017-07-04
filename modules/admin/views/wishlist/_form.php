<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Wishlist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wishlist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username'), ['id'=>'id']) ?>

    <?= $form->field($model, 'product_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\Products::find()->all(), 'id', 'name'), ['id'=>'id']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
