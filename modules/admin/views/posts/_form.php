<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 2/28/17
 * Time: 11:16 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */

$dataCategory   = \yii\helpers\ArrayHelper::map(\app\models\CategoryPost::find()->all(), 'id', 'name');
$data_category  = \yii\helpers\ArrayHelper::map(\app\models\PostCate::find()->where('post_id ='.intval($model->id))->all(),'id','cate_post_id');

$dataTags       = \yii\helpers\ArrayHelper::map(\app\models\TagsPost::find()->all(), 'id', 'name');
$data_tags      = \yii\helpers\ArrayHelper::map(\app\models\PostTag::find()->where('post_id ='.intval($model->id))->all(),'id','tag_post_id');

?>

<div class="posts-form">

      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-posts-categories required">
        <label class="control-label" for="posts-categories-name"><?= Yii::t('app','Categories') ?></label>
            <?php
        echo Select2::widget([
            'name' => 'Posts[category]',
            'value'=> $data_category,
            'data' => $dataCategory,
            'theme' => Select2::THEME_CLASSIC,
            'options' => [
                'multiple' => true,
                'placeholder' => 'Search...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '860'

            ],
        ]);
        ?>
    </div>
    
    <div class="form-group field-posts-tags required">
        <label class="control-label"><?= Yii::t('app','Tags') ?></label>
        <?php           
            echo Select2::widget([
                'name'  => 'Posts[tags]',
                'value' => $data_tags,
                'data'  => $dataTags,
                'maintainOrder' => true,
                'options' => ['placeholder' => 'Tags...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'maximumInputLength' => 35
                ],
        ]); ?>
    </div>

     <?= $form->field($model, 'image')->fileInput(['maxlength' => 255, 'class'=>' btn btn-primary']) ?>
     <?php
    if($model->image){
        echo Html::img('/'.$model->image, ['width'=>'90'] );
    }
    ?>

    <?php  $model->is_comment = isset($model->is_comment)?$model->is_comment: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_comment')->checkbox() ?>

    <?php  $model->is_status = isset($model->is_status)?$model->is_status: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_status')->checkbox() ?>

    <?= $form->field($model, 'web_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
   $(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
    });
</script>
