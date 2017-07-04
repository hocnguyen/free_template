<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'countryCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'countryName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currencyCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'population')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isoNumeric')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'languages')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isoAlpha3')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
