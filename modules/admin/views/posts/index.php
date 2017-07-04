<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content posts-index">
    <div class="container-fluid categories-index">
     <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>    

        <?php  
        $gridColumns = [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'options'=>['style'=>'width:55px;'],
            ], 
            'title',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value'=>function($data) { return $data->imageurl; },
                'contentOptions' => ['class' => 'img-back-end-view'],
                'options'   =>['style'=>'width:75px;'],
            ],
            [
                'label'  => Yii::t('app','Category'),
                'attribute' => 'categoryName',
                'format' => 'html',
                'value'  => function($data) { return $data->categories; },
                'options'   =>['style'=>'width:150px;'],

            ],
            [
                'label'     => Yii::t('app','Tags'),
                'attribute' => 'tagName',
                'format'    => 'html',
                'value'=>function($data) { return $data->tags; },
                'options'   =>['style'=>'width:90px;']
            ],
            [
                'attribute' => 'is_status',
                'format'    => 'html',
                'value'     => function($data) { return $data->active; },
                'filter'    => Yii::$app->params['active_display'],
                'options'   =>['style'=>'width:89px;'],
            ],
            [
                'attribute' => 'user_id',
                'format'    => 'raw',
                'value'     => function($data) { return $data->user; },
            ], 
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
        'id' => 'posts-designwebvn-grid',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
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
