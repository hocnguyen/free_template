<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BannersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use dosamigos\datepicker\DatePicker;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content banners-index">
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
                'attribute' => 'filename',
                'format' => 'html',
                'value'=>function($data) { return $data->imageurl; },
                'contentOptions' => ['class' => 'img-back-end-view'],
                'options'   =>['style'=>'width:95px;'],
            ],
            [
                'attribute' => 'position',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['banner_position'],
                'value'     => function($data) { return $data->namePosition; },
            ],
            [
                'attribute' => 'type',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['banner_type'],
                'value'     => function($data) { return $data->nameType; },
            ],
            [
                'attribute' => 'is_order',
                'format'    => 'raw',
                'options'   =>['style'=>'width:96px;'],
            ],
            [
                'attribute' => 'is_active',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['active_status'],
                'value'     => function($data) { return $data->statusBannersAjax; },
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
                'class' => 'yii\grid\ActionColumn',
                'header'    => Yii::t('app','Actions'),
                'options'   => ['style'=>'width:90px;'],
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
        'id' => 'banners-designwebvn-grid',
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
<script>
    function ajaxUpdateStatus( id ){
        $.get('<?= Yii::$app->params['url_admin'] ?>/banners/ajaxupdate?id='+id, function(html) {
            $.pjax.reload({container:'#w1'});
        });
    }
    function setUp(id){
        $.get('<?= Yii::$app->params['url_admin'] ?>/banners/up?id='+id, function(html) {
            $.pjax.reload({container:'#w1'});
        });
    }
    function setDown(id){
        $.get('<?= Yii::$app->params['url_admin'] ?>/banners/down?id='+id, function(html) {
            $.pjax.reload({container:'#w1'});
        });
    }
</script>
