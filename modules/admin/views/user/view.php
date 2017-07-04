<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content user-view">
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
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value'=>function($data) { return $data->imageurl; }
            ],
            'username',
            'email:email',
            [
                'attribute' => 'role',
                'format'    => 'html',
                'value'     => function($data) { return $data->roleUser; }
            ],
            [
                'attribute' => 'status',
                'format'    => 'html',
                'value'     => function($data) { return $data->display; }
            ],
            'fname',
            'lname',
            'address',
            'phone',
            [
                'attribute' => 'id_read',
                'value'     =>  function($data) {
                    return $data->read;
                },
                'format'    => 'raw',
            ],
            'created',
            'updated'
        ],
    ]) ?>
  </div>
</div>
