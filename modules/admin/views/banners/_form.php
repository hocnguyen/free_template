<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\models\Banners;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banners-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php  $model->is_active = isset($model->is_active)?$model->is_active: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'position')->dropDownList( Yii::$app->params['banner_position'] ) ?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->params['banner_type'], ['empty' => Yii::t('app', '--- Please choose ---')] ) ?>

    <div id="image_flash_type">
        <?= $form->field($model, 'filename')->fileInput() ?>
        <?php if ($model->filename && ($model->type == Banners::TYPE_IMAGE || $model->type == Banners::TYPE_FLASH)){
            $source = Yii::$app->basePath."/web/uploads/banners/$model->filename";
            if (is_file($source)){
                if ($model->type == Banners::TYPE_IMAGE):?>
                    <a class='galery-simple' href="<?php echo Yii::getAlias('@uploads'); ?>/banners/<?php echo $model->filename?>">
                        <img src="<?php echo Yii::getAlias('@uploads'); ?>/banners/<?php echo $model->filename?>" style="height:50px" />
                    </a>
                <?php else:
                    list($width, $height) = getimagesize($source);
                    if ($height > 100){
                        $scare = $height/100;
                        $height = ceil($height/$scare);
                        $width = ceil($width/$scare);
                    }

                    ?>
                    <object width="<?php echo $width?>" height="<?php echo $height?>" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                            codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
                        <param name="src" value="<?php echo Yii::getAlias('@uploads'); ?>/banners/<?php echo $model->filename?>" />
                        <embed src="<?php echo Yii::getAlias('@uploads'); ?>/banners/<?php echo $model->filename?>" width="<?php echo $width?>" height="<?php echo $height?>" />
                    </object>
                <?php endif;
            }
        }
        ?>
    </div>

    <div id="content_type">
    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>
    </div>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    jQuery(document).ready(function(){
        $("#image_flash_type").show();
        $("#content_type").hide();
        $("#banners-type").change(function(){
            if (this.value == '<?php echo \app\models\Banners::TYPE_FLASH ?>' || this.value == '<?php echo \app\models\Banners::TYPE_IMAGE; ?>'){
                $("#image_flash_type").show();
                $("#content_type").hide();
            }
            else{
                $("#image_flash_type").hide();
                $("#content_type").show();
            }
        });
        if ('<?= $model->id ?>'){
            $("#banners-type").change();
        }
    });
</script>
