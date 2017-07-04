<?php 
	use yii\helpers\Html;
	use kartik\grid\GridView;
	use kartik\select2\Select2;
?>
<section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><a href="<?= Yii::$app->params['url_admin'] ?>/products"><?= Yii::t('app','Products') ?></a></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
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
            'name',
            [
                'attribute' => 'price',
                'format' => 'raw',
                'options'=>['style'=>'width:68px;'],
            ],
            [
                'attribute' => 'is_status',
                'format'    => 'html',
                'value'     => function($data) { return $data->active; },
                'filter'    => Yii::$app->params['active_display'],
                'options'   =>['style'=>'width:79px;'],
            ],
            [
                'header' => Yii::t('app','Actions'),
                'options'=>['style'=>'width:79px;'],
                'class' => 'yii\grid\ActionColumn'
            ],
        ];

        echo GridView::widget([
        'id' => 'products-designwebvn-grid',
        'dataProvider'=>$dataProducts,
        'filterModel'=>$searchProducts,
        'columns'=>$gridColumns,
        'pjax'=>true,
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'persistResize'=>false,
    	]); 
    ?>
	                    </div>
	                </section>