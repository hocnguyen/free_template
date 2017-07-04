<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content posts-view">
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
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
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
            'description:html',
            'content:html',
            'web_url:url',
             [
                'attribute' => 'is_comment',
                'value'     =>  ($model->is_comment==1)?Yii::t("app","Enable"):Yii::t("app","Disable"),
                'format'    => 'raw',
            ],
            [
                'attribute' => 'is_status',
                'value'     =>  ($model->is_status==1)?Yii::t("app","Enable"):Yii::t("app","Disable"),
                'format'    => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'value'     =>  function($data) { return $data->user; },
                'format'    => 'raw',
            ],
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
