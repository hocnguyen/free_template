<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use dosamigos\datepicker\DatePicker;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
?>
<div class="page-content sub-page-content">
    <div class="container-fluid categories-index">
     <?php echo yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>
  
        <?php  
        $parent_category   = \yii\helpers\ArrayHelper::map(\app\models\Categories::find()->where('parent_id =:parent_id',[':parent_id'=>0])->all(), 'id', 'name');
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
                        'options'   =>['style'=>'width:65px;'],
                    ], 
                    [
                        'attribute' => 'image_hot',
                        'format' => 'html',
                        'value'=>function($data) { return $data->imageurlhot; },
                        'contentOptions' => ['class' => 'img-back-end-view'],
                        'options'   =>['style'=>'width:120px;'],
                    ],   
                    'name',
                    [
                        'attribute' => 'parent_id',
                        'format'    => 'html',
                        'value'     => function($data) { return $data->parentCategory; },
                        'filter'    => $parent_category,
                        'options'   => ['style'=>'width:168px;'],
                    ],   
                    [
                        'attribute' => 'is_display',
                        'format'    => 'html',
                        'value'     => function($data) { return $data->display; },
                        'filter'    => Yii::$app->params['active_display'],
                        'options'   =>['style'=>'width:95px;'],
                    ],
                    [
                        'attribute' => 'is_hot',
                        'format'    => 'html',
                        'value'     => function($data) { return $data->hot; },
                        'filter'    => Yii::$app->params['active_display'],
                        'options'   =>['style'=>'width:95px;'],
                    ],
                    [
                        'attribute' => 'is_order',
                        'format' => 'raw',
                        'options'=>['style'=>'width:86px;'],
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
        'id' => 'designwebvn-grid',
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
        'responsive'=>true,
        'hover'=>true,
        'showPageSummary'=>$pageSummary,
        'persistResize'=>false,
        'exportConfig'=>$exportConfig,
    ]); ?>
        
       
  </div>
</div>
<script type="text/javascript">
    function setUp(id){
        $.get('<?= Yii::$app->params['url_admin'] ?>/categories/up?id='+id, function(html) {
        });
    }
    function setDown(id){
        $.get('<?= Yii::$app->params['url_admin'] ?>/categories/down?id='+id, function(html) {
        
        });
    }
</script>