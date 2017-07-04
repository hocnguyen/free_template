<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SlidershowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;

$this->title = Yii::t('app', 'Slidershows');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content slidershow-index">
    <div class="container-fluid categories-index">
     <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>    

        <?php  
        $gridColumns = [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'options'=>['style'=>'width:55px;'],
            ],
            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value'=>function($data) { return $data->imageurl; },
                'contentOptions' => ['class' => 'img-back-end-view'],
                'options'   =>['style'=>'width:95px;'],
            ],
            'link:url',
            [
                'attribute' => 'created',
                'value'     => 'created',
                'format'    =>'raw',
                'options'=>['style'=>'width:179px;'],
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
                'options'=>['style'=>'width:120px;'],
                'class' => 'yii\grid\ActionColumn',
                'template'  => '{view} {update} {delete} {up} {down}',
                'buttons'=>[
                    'up' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', $url, [
                                'title' => Yii::t('yii', 'Up'),
                            ]);

                        },
                    'down' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', $url, [
                                'title' => Yii::t('yii', 'Down'),
                            ]);
                        }
                ]
            ],
        ];

        echo GridView::widget([
        'id' => 'slidershow-designwebvn-grid',
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
