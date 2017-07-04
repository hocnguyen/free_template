<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BannersCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;

$this->title = Yii::t('app', 'Banners Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content banners-category-index">
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
                'format' => 'html',
                'value'=>function($data) { return $data->imageurl; },
                'contentOptions' => ['class' => 'img-back-end-view'],
                'options'   =>['style'=>'width:95px;'],
            ],
            [
                'attribute' => 'categoryName',
                'value'     => function($data) { return $data->categoryName; },
                'format'    => 'raw',
            ],
            'name',
            [
                'attribute' => 'position',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['banner_position'],
                'value'     => function($data) { return $data->namePosition; },
            ],
            [
                'attribute' => 'is_active',
                'format'    => 'raw',
                'filter'    => Yii::$app->params['active_status'],
                'value'     => function($data) { return $data->statusBannersAjax; },
            ],      
            'link:url',
            [
                'attribute' => 'created',
                'value'     => 'created',
                'format'    =>'raw',
                'options'   =>['style'=>'width:150px;'],
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
        'id' => 'banners-category-designwebvn-grid',
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
        $.get('<?= Yii::$app->params['url_admin'] ?>/bannerscategory/ajaxupdate?id='+id, function(html) {
            $.pjax.reload({container:'#w1'});
        });
    }
</script>