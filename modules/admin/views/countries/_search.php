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
/* @var $model app\models\CountriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'countryCode') ?>

    <?= $form->field($model, 'countryName') ?>

    <?= $form->field($model, 'currencyCode') ?>

    <?= $form->field($model, 'population') ?>

    <?php // echo $form->field($model, 'isoNumeric') ?>

    <?php // echo $form->field($model, 'languages') ?>

    <?php // echo $form->field($model, 'isoAlpha3') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
