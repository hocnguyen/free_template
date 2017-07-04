<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="page-content sub-page-content">
        <div class="container-fluid">
        <?php echo yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'parent_id',
                'value'     =>  function($data) { return $data->parentCategory; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'image',
                'value'     =>  function($data) { return $data->imageurl; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'image_hot',
                'value'     =>  function($data) { return $data->imageurlhot; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'is_display',
                'value'     =>  ($model->is_display==1)?Yii::t("app","Enable"):Yii::t("app","Disable"),
                'format'    => 'raw',
            ],
            [
                'attribute' => 'is_hot',
                'value'     =>  ($model->is_hot==1)?Yii::t("app","Enable"):Yii::t("app","Disable"),
                'format'    => 'raw',
            ],
            'is_order',
            'created',
            'updated',
        ],
    ]) ?>
</div>
</div>
