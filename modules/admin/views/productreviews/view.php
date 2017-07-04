<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\ProductReviews */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content product-reviews-view">
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
                'attribute' => 'memberName',
                'format'    => 'html',
                'value'     => function($data) { return $data->memberName; },
            ],
            [
                'attribute' => 'productName',
                'format'    => 'html',
                'value'     => function($data) { return $data->productName; },
            ],
            [
                'attribute' => 'rate',
                'value'     =>  StarRating::widget([
                                    'name' => 'rate',
                                    'value' => $model->rate,
                                    'disabled' => true
                                ]),
                'format'    => 'raw',
            ],
            'comment:html',
            [
                'attribute' => 'is_display',
                'format'    => 'html',
                'value'     => function($data) { return $data->display; },
            ],
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
