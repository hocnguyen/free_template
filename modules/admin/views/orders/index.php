<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content orders-index">
    <div class="container-fluid categories-index">
     <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>    
        <?php  
        $filter_status      = yii\helpers\ArrayHelper::map(\app\models\OrderStatus::find()->where('')->all(), 'id','name');
        $gridColumns = [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'options'=>['style'=>'width:55px;'],
            ],
            [
                'label'  => Yii::t('app','Customer'),
                'attribute' => 'customerName',
                'format' => 'html',
                'value'  => function($data) { return $data->memberName; },
                'options'   =>['style'=>'width:135px;'],

            ],
            [
                'attribute' => 'productName',
                'value'     => function($data) { return $data->productName; },
                'format'    => 'raw',
                'options'   =>['style'=>'width:250px;'],
            ],
            [
                'attribute' => 'quantity',
                'value'     => function($data) { return $data->quantity; },
                'format'    => 'raw',
                'options'   =>['style'=>'width:86px;'],
            ],
            [
                'attribute' => 'unitPrice',
                'value'     => function($data) { return $data->unitPrice; },
                'format'    => 'raw',
                'options'   =>['style'=>'width:86px;'],
            ],
            [
                'attribute' => 'amount',
                'value'     => function($data) { return $data->totalAmount; },
                'format' => 'raw',
                'options'=>['style'=>'width:75px;'],
            ],
            [
                'attribute' => 'status_id',
                'format'    => 'raw',
                'filter'    => $filter_status,
                'value'     => function($data) { return $data->nameStatus; },
                'options'=>['style'=>'width:120px;'],
            ],
            [
                'attribute' => 'id_read',
                'format' => 'html',
                'value' => function($data) {
                    return $data->read;
                },
                'filter' => Yii::$app->params['status_read'],
                'options' => ['style' => 'width:168px;'],
            ],
            [
                'attribute' => 'created',
                'value'     => 'created',
                'format'    =>'raw',
                'options'   =>['style'=>'width:120px;'],
                'filter'    => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                    ]),
            ],
            [
                'header' => Yii::t('app','Actions'),
                'options'=>['style'=>'width:90px;'],
                'class' => 'yii\grid\ActionColumn'
            ],
        ];

        echo GridView::widget([
        'id' => 'orders-designwebvn-grid',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'rowOptions' => function($model){
            if($model->id_read == 0){
                return ['class' => 'unread'];
            }
        },
        'panel'=>['type'=>'primary', 'heading'=> Html::encode($this->title), 'footer'=> Yii::t('app','Total Money').': '.Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyOrders()).' <br> '.Yii::t('app','Money Approved'). ': '.Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyApproved()).' <br> '.Yii::t('app','Money Pending'). ': '.Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyPending())  ],
        'pjax'=>true,
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class'=>'btn btn-primary'])
            ],
            '{export}',
            '{toggleData}',
        ],
        'export'=>[
            'fontAwesome'=>true
        ],
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'showPageSummary'=>$pageSummary,
        'persistResize'=>false,
        'exportConfig'=>$exportConfig,
    ]); ?>

    </div>
</div>
