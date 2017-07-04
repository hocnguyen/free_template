<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content banners-view">
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
            'name',
             [
                'attribute' => 'position',
                'format'    => 'raw',
                'value'     => function($data) { return $data->namePosition; },
            ],
            [
                'attribute' => 'type',
                'format'    => 'raw',
                'value'     => function($data) { return $data->nameType; },
            ],
            [
                'attribute' => 'is_active',
                'format'    => 'raw',
                'value'     => function($data) { return $data->statusBannersAjax; },
            ],
            [
                'attribute' => 'filename',
                'value'     =>  function($data) { return $data->imageurl; },
                'format'    => 'raw',
            ],
            'content:html',
            'link',
            'is_order',
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
