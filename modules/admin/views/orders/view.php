<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content orders-view">
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
                'label'  => Yii::t('app','Customer'),
                'attribute' => 'customerName',
                'format' => 'html',
                'value'  => function($data) { return $data->memberName; }

            ],
            [
                'attribute' => 'productName',
                'value'     => function($data) { return $data->productName; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'quantity',
                'value'     => function($data) { return $data->quantity; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'unitPrice',
                'value'     => function($data) { return $data->unitPrice; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'amount',
                'value'     => function($data) { return $data->totalAmount; },
                'format' => 'raw',
            ],
            'transaction_id',
             [
                'attribute' => 'status_id',
                'format'    => 'raw',
                'value'     => function($data) { return $data->nameStatus; },
            ],
            [
                'attribute' => 'id_read',
                'value'     =>  function($data) {
                    return $data->read;
                },
                'format'    => 'raw',
            ],
            //'type',
            //'sesssion_customer',
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
