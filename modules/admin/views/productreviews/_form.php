<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\ProductReviews */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username'), ['id'=>'id']) ?>

    <?= $form->field($model, 'product_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\Products::find()->all(), 'id', 'name'), ['id'=>'id']) ?>

    <?= $form->field($model, 'rate')->widget(StarRating::classname(), [
    'pluginOptions' => ['step' => 0.1]
    ]); ?>

    <?php  $model->is_display = isset($model->is_display)?$model->is_display: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_display')->checkbox() ?>

    <?= $form->field($model, 'comment')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
