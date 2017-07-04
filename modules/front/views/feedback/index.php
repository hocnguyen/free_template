<?php
error_reporting(0);
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;
use kartik\rating\StarRating;

$this->title = Yii::t('app', 'Product Reviews');
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
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'options'   =>['style'=>'width:55px;']
            ],
            [
                'attribute' => 'productName',
                'value'     => function($data) { return $data->productNameFE; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'rate',
                'value'     => function($data) { return $data->rateStar; },         
                'format'    => 'raw',
            ],
            'comment:html',
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
                'class' => 'yii\grid\ActionColumn',
                'template'  => '{view}'
            ],
        ];

        echo GridView::widget([
        'id' => 'product-reviews-designwebvn-grid',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'panel'=>['type'=>'primary', 'heading'=> Html::encode($this->title) ],
        'pjax'=>true,
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class'=>'btn btn-primary'])
            ],
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
        'persistResize'=>false,
    ]); ?>
            </div>
        </div>
    </div>
</div>
