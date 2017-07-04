<?php
	use dosamigos\datepicker\DatePicker;
	use kartik\grid\GridView;
	use yii\helpers\Html;
?>
<section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><a href="<?= Yii::$app->params['url_admin'] ?>/statsbydate"><?= Yii::t('app','Statistics by Date') ?></a></h3>
	                    </header>
	     
	                    <div class="box-typical-body panel-body">
                        <?php  
                        $gridColumns = [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'options'   =>['style'=>'width:55px;']
                            ],
                            'created',
                            [
                                'attribute' => 'amount',
                                'format'    => 'html',
                                'value'     => function($data){
                                        return Yii::$app->func->formatPrice($data['amount']);
                                    }
                            ],
                            'transaction_id'      
                        ];

                        echo GridView::widget([
                        'id' => 'statsbydate-designwebvn-grid',
                        'dataProvider'=>$dataProvider,
                        'columns'=>$gridColumns,
                        'pjax'=>true,
                        'bordered'=>true,
                        'striped'=>true,
                        'condensed'=>true,
                        'responsive'=>true,
                        'hover'=>true,
                        'persistResize'=>false,
                        'exportConfig'=>false,
                    ]); ?>
                            <div class="footer-stats-by-date"> <?php echo Yii::t('app','Total Money').': '.Yii::$app->func->formatPrice($total_money) ?> </div>
                         </div>
	                </section>