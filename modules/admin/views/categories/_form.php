<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
$data   = \yii\helpers\ArrayHelper::map(\app\models\Categories::find()->where('parent_id =:parent_id',[':parent_id'=>0])->all(), 'id', 'name');
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
    'data' => $data,
    'options' => ['placeholder' => 'Select a Parent Category ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
    ]); ?>
 
    <?= $form->field($model, 'image')->fileInput(['maxlength' => 255, 'class'=>'btn btn-rounded']) ?>

    <?php
    if($model->image){
        echo Html::a( Html::img(Yii::getAlias('@uploads').'/categories/'.$model->image, ['width'=>'90'] ), [Yii::getAlias('@uploads').'/categories/'.$model->image], ['class'=>'galery-simple'] )." <br>";
    }
    ?>

    <?= $form->field($model, 'image_hot')->fileInput(['maxlength' => 255, 'class'=>'btn btn-rounded']) ?>

    <?php
    if($model->image_hot){
        echo Html::a( Html::img(Yii::getAlias('@uploads').'/categories/'.$model->image_hot, ['width'=>'90'] ), [Yii::getAlias('@uploads').'/categories/'.$model->image_hot], ['class'=>'galery-simple'] )." <br>";
    }
    ?>

    <?php  $model->is_hot = isset($model->is_hot)?$model->is_hot: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_hot')->checkbox() ?>

     <?php  $model->is_display = isset($model->is_display)?$model->is_display: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_display')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
