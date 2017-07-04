<?php
	use kartik\grid\GridView;
	use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
?>
<section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><a href="<?= Yii::$app->params['url_admin'] ?>/user"><?= Yii::t('app','Customers') ?></a></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                       <?php  
        $gridColumns = [
             [
                        'attribute' => 'id',
                        'format' => 'raw',
                        'options'=>['style'=>'width:35px;'],
            ],  
            'username:html',
            'email:email',
            [
                'attribute' => 'status',
                'format'    => 'html',
                'value'     => function($data) { return $data->display; },
                'filter'    => Yii::$app->params['status_user'],
                'options'   =>['style'=>'width:100px;'],
            ],
            [
                'header' => Yii::t('app','Actions'),
                'options'=>['style'=>'width:80px;'],
                'class' => 'yii\grid\ActionColumn'
            ],
        ];

        echo GridView::widget([
        'id' => 'members-designwebvn-grid',
        'dataProvider'=>$dataMembers,
        'filterModel'=>$searchMembers,
        'columns'=>$gridColumns,
        'pjax'=>true,
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'persistResize'=>false,
        'exportConfig'=>true,
    ]); ?>
	                    </div>
	                </section>