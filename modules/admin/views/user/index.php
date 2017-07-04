<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use dosamigos\datepicker\DatePicker;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content user-index">
    <div class="container-fluid categories-index">
     <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>    

        <?php  
        $gridColumns = [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'options'=>['style'=>'width:55px;'],
            ], 
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value'=>function($data) { return $data->imageurl; },
                'contentOptions' => ['class' => 'img-back-end-view'],
                'options'   =>['style'=>'width:95px;'],
            ],
            'username',
            'email:email',
            [
                'attribute' => 'role',
                'format'    => 'html',
                'value'     => function($data) { return $data->roleUser; },
                'filter'    => '',
                'options'   =>['style'=>'width:100px;'],
            ],
            [
                'attribute' => 'status',
                'format'    => 'html',
                'value'     => function($data) { return $data->display; },
                'filter'    => Yii::$app->params['status_user'],
                'options'   =>['style'=>'width:100px;'],
            ],
            'fname',
            'lname',
            [
                'attribute' => 'id_read',
                'format' => 'html',
                'value' => function($data) {
                    return $data->read;
                },
                'filter' => Yii::$app->params['status_read'],
                'options' => ['style' => 'width:168px;'],
            ],
            // 'phone',
            [
                'attribute' => 'created',
                'value'     => 'created',
                'format'    =>'raw',
                'options'   =>['style'=>'width:179px;'],
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
        'id' => 'user-designwebvn-grid',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'rowOptions' => function($model){
            if($model->id_read == 0){
                return ['class' => 'unread'];
            }
        },
        'panel'=>['type'=>'primary', 'heading'=> Html::encode($this->title) ],
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
