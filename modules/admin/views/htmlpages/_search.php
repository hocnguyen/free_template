<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HtmlPagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="html-pages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pagecode') ?>

    <?= $form->field($model, 'page_name') ?>

    <?= $form->field($model, 'page_title') ?>

    <?= $form->field($model, 'page_heading') ?>

    <?php // echo $form->field($model, 'page_text') ?>

    <?php // echo $form->field($model, 'is_status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
