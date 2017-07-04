<?php
	use dosamigos\datepicker\DatePicker;
	use kartik\grid\GridView;
	use yii\helpers\Html;
?>
<section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><?= Yii::t('app','Contacts') ?></h3>
	                    </header>
	     
	                    <div class="box-typical-body panel-body">
        <?php  
        $gridColumns = [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'options'=>['style'=>'width:55px;'],
            ], 
            'title',
            'email:email',
            [
                'attribute' => 'id_read',
                'format' => 'html',
                'value' => function($data) {
                    return $data->read;
                },
                'filter' => Yii::$app->params['status_read'],
                'options' => ['style' => 'width:168px;'],
            ],
            [
                'attribute' => 'created',
                'value'     => 'created',
                'format'    =>'raw',
                'options'   =>['style'=>'width:179px;'],
                'filter'    => DatePicker::widget([
                    'model' => $searchContacts,
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
        'id' => 'contacts-designwebvn-grid',
        'dataProvider'=>$dataContacts,
        'filterModel'=>$searchContacts,
        'columns'=>$gridColumns,
        'pjax'=>true,
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'persistResize'=>false,

    ]); ?>

    </div>
	                </section><!--.box-typical-dashboard-->