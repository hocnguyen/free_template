<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Statistics by Date');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content user-index">
    <div class="container-fluid categories-index">
     <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>    
        <?php  
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'options'   =>['style'=>'width:55px;']
            ],
            'created',
            [
                'attribute' => 'amount',
                'format'    => 'html',
                'value'     => function($data){
                        return Yii::$app->func->formatPrice($data['amount']);
                    }
            ],
            [
                'label' => "Status",
                'value' => function($data){
                        return \app\models\Orders::GetNameStatusBest($data['status_id']);
                    }
            ],
            'transaction_id'      
        ];

        echo GridView::widget([
        'id' => 'user-designwebvn-grid',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'panel'=>['type'=>'primary', 'heading'=> Html::encode($this->title) , 'footer'=> Yii::t('app','Total Money').': '.Yii::$app->func->formatPrice($total_money)],
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
