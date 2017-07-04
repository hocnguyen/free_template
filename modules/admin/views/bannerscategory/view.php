<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BannersCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content banners-category-view">
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
                'attribute' => 'categoryName',
                'value'     => function($data) { return $data->categoryName; },
                'format'    => 'raw',
            ],
            'name',
            [
                'attribute' => 'position',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['banner_position'],
                'value'     => function($data) { return $data->namePosition; },
            ],
            [
                'attribute' => 'is_active',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['active_status'],
                'value'     => function($data) { return $data->statusBannersAjax; },
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value'=>function($data) { return $data->imageView; }
            ], 
            'link:url',
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
