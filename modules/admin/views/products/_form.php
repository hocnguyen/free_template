<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
error_reporting(0);
/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */

$dataCategory   = \yii\helpers\ArrayHelper::map(\app\models\Categories::find()->all(), 'id', 'name');
$data_category  = \yii\helpers\ArrayHelper::map(\app\models\ProductCategories::find()->where('product_id ='.intval($model->id))->all(),'id','category_id');

$dataManufacturer   = \yii\helpers\ArrayHelper::map(\app\models\Manufacturers::find()->all(), 'id', 'name');
$data_manufacturer  = \yii\helpers\ArrayHelper::map(\app\models\ProductManufacturers::find()->where('product_id ='.intval($model->id))->all(),'id','manufacturers_id');

$dataTags           = \yii\helpers\ArrayHelper::map(\app\models\Tags::find()->all(), 'id', 'name');
$data_tags          = \yii\helpers\ArrayHelper::map(\app\models\ProductTags::find()->where('product_id ='.intval($model->id))->all(),'id','tag_id');


?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-products-categories required">
        <label class="control-label" for="products-categories-name"><?= Yii::t('app','Categories') ?></label>
            <?php
        echo Select2::widget([
            'name' => 'Products[category]',
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

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'special_price')->textInput() ?>

    <div class="form-group field-products-tags required">
        <label class="control-label"><?= Yii::t('app','Tags') ?></label>
        <?php           
            echo Select2::widget([
                'name'  => 'Products[tags]',
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
        echo Html::a( Html::img('/'.$model->image, ['width'=>'90'] ), ['/'.$model->image], ['class'=>'galery-simple'] )." <br>";
    }
    ?>
    <?php
        $images = [];
        if($model->id){
            $images         = \app\models\ProductPics::getAllImgModelById($model->id);
        }
    ?>
     <div class="form-group">
        <label for="model-video_path" class="control-label">Photos</label>
        <input type="hidden" id="path_photos" name="photos-models-section" class="form-control">
        <input id="input-705" name="photos[]" type="file" multiple class="file-loading">
        <script>
            var $input = $("#input-705");
            $input.fileinput({
                uploadUrl: "<?= Yii::$app->params['url_admin'] ?>/products/uploadphoto", // server upload action
                uploadAsync: false,
                showUpload: false, // hide upload button
                showRemove: true, // hide remove button
                minFileCount: 1,
                maxFileCount: 10,
                overwriteInitial: false,
                <?php if( count($images) ){ ?>
                initialPreview: [
                    <?php  foreach($images as $ke=>$va){ ?>
                    "<img style='width:250px; height:auto; max-height: 100%; max-width: 100%;' src='/<?php echo $va['image_path']; ?>'>",
                    <?php } ?>
                ],
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    <?php  foreach($images as $val){ ?>
                    {caption: "<?php echo $model->name; ?>", width: "120px", url: "<?= Yii::$app->params['url_admin'] ?>/products/deletephoto", key: <?php echo $val['id']; ?>},
                    <?php } ?>
                ],
                <?php
                }
                ?>
                uploadExtraData: function () {
                    return {
                        name_model: $('#name-model').val()
                    };
                }
            }).on("filebatchselected", function(event, data, files) {
                $input.fileinput("upload");
            });
            $input.on('filebatchuploaderror', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;

            });

            $input.on('filebatchuploadsuccess', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;
                $("#path_photos").val(response.uploaded);
            });


        </script>
    </div>

    <?= $form->field($model, 'url_video')->textInput() ?>

    <?php  $model->is_status = isset($model->is_status)?$model->is_status: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_status')->checkbox() ?>

    <?php  $model->is_wishlist = isset($model->is_wishlist)?$model->is_wishlist: Yii::$app->params['status_active'] ?>
    <?= $form->field($model, 'is_wishlist')->checkbox() ?>

    <?= $form->field($model, 'short_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'full'
    ]) ?>

     <?= $form->field($model, 'full_dsscription')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
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