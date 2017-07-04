<?php
error_reporting(0);
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;

$this->title = Yii::t('app', 'My Orders');
?>
<div class="columns-container">
    <div class="container" id="columns">
       <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <h2 class="compare-heading">
            <span class="page-heading-title2"><?= $this->title ?></span>
        </h2>
        <div class="row">

            <?=  yii\base\View::render('../elements/widget/left_menu', []); ?>

        <div class="center_column col-xs-12 col-sm-9" id="center_column">    
        <?php  
        $filter_status      = yii\helpers\ArrayHelper::map(\app\models\OrderStatus::find()->where('')->all(), 'id','name');
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'options'   =>['style'=>'width:55px;']
            ],
            [
                'attribute' => 'productName',
                'value'     => function($data) { return $data->productNameFE; },
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
                'class' => 'yii\grid\ActionColumn',
                'template'  => '{view}'                  
            ],
        ];

        echo GridView::widget([
        'id' => 'orders-designwebvn-grid',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'panel'=>['type'=>'primary', 'heading'=> Html::encode($this->title) ],
        'pjax'=>true,
        'toolbar'=> [
            '{toggleData}'
        ],
        'export'=>[
            'fontAwesome'=>true
        ],
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'persistResize'=>false,
    ]); ?>
    </div>
        </div>
    </div>
</div>
