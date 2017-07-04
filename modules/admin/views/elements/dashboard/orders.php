<?php 
	use yii\helpers\Html;
	use kartik\grid\GridView;
	use dosamigos\datepicker\DatePicker;
?>
<section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><a href="<?= Yii::$app->params['url_admin'] ?>/orders"><?= Yii::t('app','Recent Orders') ?></a></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                       <?php  
        $filter_status      = yii\helpers\ArrayHelper::map(\app\models\OrderStatus::find()->where('')->all(), 'id','name');
        $gridColumns = [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'options'=>['style'=>'width:55px;'],
            ],
            [
                'label'  => Yii::t('app','Member'),
                'attribute' => 'customerName',
                'format' => 'html',
                'value'  => function($data) { return $data->memberName; },
                'options'   =>['style'=>'width:135px;'],

            ],
            [
                'attribute' => 'amount',
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
                    'model' => $searchOrders,
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
        'dataProvider'=>$dataOrders,
        'filterModel'=>$searchOrders,
        'columns'=>$gridColumns,
        'pjax'=>true,
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'persistResize'=>false,
    ]); ?>
<div class="footer-stats-by-date"><?=
                                Yii::t('app','Total Money').': '.Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyOrders()).' <br> '.Yii::t('app','Money Approved'). ': '.Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyApproved()).' <br> '.Yii::t('app','Money Pending'). ': '.Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyPending())
                         ?></div>
	                    </div>
                        
	                </section>