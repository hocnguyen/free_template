<?php
error_reporting(0);
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\rating\StarRating;

$this->title = Yii::t('app', 'Create Product Reviews');
?>
<div class="columns-container">
    <div class="container" id="columns">
       <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <h2 class="compare-heading">
            <span class="page-heading-title2"><?= $this->title ?></span>
        </h2>
        <div class="row">
            <?=  yii\base\View::render('../elements/widget/left_menu', []); ?>
        <div class="center_column col-xs-12 col-sm-9" id="center_column"> 
             <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="msg-danger msg">
                    <p>
                        <?php echo Yii::$app->session->getFlash('error') ?>
                        <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                    </p>
                </div>
             <?php endif; ?>

                <?php 
                    $lists = Yii::$app->func->listProductIdByCustomer(Yii::$app->user->id);
                    $products_id = count($lists) > 0 ?implode(',', $lists):0;
                ?>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'product_id')->textInput()->dropDownList( \yii\helpers\ArrayHelper::map(\app\models\Products::find()->where('id IN ('.$products_id.')')->all(), 'id', 'name'), ['id'=>'id']) ?>

                <?= $form->field($model, 'rate')->widget(StarRating::classname(), [
                'pluginOptions' => ['step' => 0.1]
                ]); ?>

                <?= $form->field($model, 'comment')->widget(CKEditor::className(), [
                    'options' => ['rows' => 3],
                    'preset' => 'full'
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>
