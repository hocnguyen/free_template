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
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content products-view">
  <div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
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
    <?php 
        $created_by =  \app\models\User::findIdentity($model->created_by);
        $updated_by =  \app\models\User::findIdentity($model->updated_by);
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'image',
                'value'     =>  Html::a( Html::img('/'.$model->image, ['width'=>'90'] ), ['/'.$model->image], ['class'=>'galery-simple'] ),
                'format'    => 'raw',
            ],
            [
                'attribute' => Yii::t('app','Categories'),
                'value'     =>  function($data) { return $data->categories; },
                'format'    => 'raw',
            ],
            [
                'attribute' => Yii::t('app','Tags'),
                'value'     =>  function($data) { return $data->tags; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'price',
                'format'    => 'raw',
                'value'     =>function($data) { return $data->retailPrice; },
            ],
            [
                'attribute' => 'special_price',
                'format'    => 'raw',
                'value'     =>function($data) { return $data->specialPrice; },
            ],
            'url_video:url',
            [
                'attribute' => Yii::t('app','Photos'),
                'value'     =>  function($data) { return $data->photos; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'is_status',
                'value'     =>  ($model->is_status==1)?Yii::t("app","Enable"):Yii::t("app","Disable"),
                'format'    => 'raw',
            ],
            [
                'attribute' => 'is_wishlist',
                'value'     =>  ($model->is_wishlist==1)?Yii::t("app","Enable"):Yii::t("app","Disable"),
                'format'    => 'raw',
            ],
            'short_description:html',
            'full_dsscription:html',
            [
                'attribute' => 'created_by',
                'value'     =>  $created_by->username,
                'format'    => 'raw',
            ],
            [
                'attribute' => 'updated_by',
                'value'     =>  $updated_by->username,
                'format'    => 'raw',
            ],
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
