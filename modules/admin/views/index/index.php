<div class="page-content sub-page-content contacts-index">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-xl-6">
	                <div class="chart-statistic-box">
	                    <div class="chart-txt">
	                        <div class="chart-txt-top">
	                            <p><span class="unit">$</span><span class="number"><?= Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyApproved(),'') ?></span></p>
	                            <p class="caption"><?= Yii::t('app','Total Money Approved') ?></p>
	                        </div>
	                        <table class="tbl-data">
	                            <tr>
	                                <td class="price color-purple">
                                    <?php $orders = \app\models\Orders::find()->where('1')->count();
                                            echo $orders; ?></td>
	                                <td><?= Yii::t('app','Orders') ?></td>
	                            </tr>
	                            <tr>
	                                <td class="price color-yellow"><?= Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyOrders()) ?></td>
	                                <td><?= Yii::t('app','Total') ?></td>
	                            </tr>
	                            <tr>
	                                <td class="price color-lime"><?= Yii::$app->func->formatPrice(Yii::$app->func->getTotalMoneyPending()) ?></td>
	                                <td><?= Yii::t('app','Pending') ?></td>
	                            </tr>
	                        </table>
	                    </div>
	                    <div class="chart-container">
	                        <div class="chart-container-in">
	                            <div id="chart_div"></div>
	                            <header class="chart-container-title">Income</header>
	                            <div class="chart-container-x">
	                                <div class="item"></div>
	                                <div class="item">tue</div>
	                                <div class="item">wed</div>
	                                <div class="item">thu</div>
	                                <div class="item">fri</div>
	                                <div class="item">sat</div>
	                                <div class="item">sun</div>
	                                <div class="item">mon</div>
	                                <div class="item"></div>
	                            </div>
	                            <div class="chart-container-y">
	                                <div class="item">300</div>
	                                <div class="item"></div>
	                                <div class="item">250</div>
	                                <div class="item"></div>
	                                <div class="item">200</div>
	                                <div class="item"></div>
	                                <div class="item">150</div>
	                                <div class="item"></div>
	                                <div class="item">100</div>
	                                <div class="item"></div>
	                                <div class="item">50</div>
	                                <div class="item"></div>
	                            </div>
	                        </div>
	                    </div>
	                </div><!--.chart-statistic-box-->
	            </div><!--.col-->
	            <div class="col-xl-6">
	            	<?=  yii\base\View::render('../elements/dashboard/stats'); ?> 
	            </div><!--.col-->
	        </div><!--.row-->
	
	        <div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <?=  yii\base\View::render('../elements/dashboard/orders',['dataOrders'=> $dataOrders, 'searchOrders' => $searchOrders]); ?> 
	                <?=  yii\base\View::render('../elements/dashboard/best_product',['dataProducts'=> $dataProducts, 'searchProducts' => $searchProducts]); ?> 
	            </div><!--.col-->
	            <div class="col-xl-6 dahsboard-column">
                    <?=  yii\base\View::render('../elements/dashboard/statsbydate', ['total_money' => $total_money, 'dataProvider' => $dataProvider]); ?>
	                <?=  yii\base\View::render('../elements/dashboard/members',['dataMembers'=> $dataMembers, 'searchMembers' => $searchMembers]); ?>   
	            </div>
	        </div>
	    </div>
	</div>

	   <script>
        $(document).ready(function() {
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Day');
                dataTable.addColumn('number', 'Values');
                // A column for custom tooltip content
                dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
                dataTable.addRows([
                    ['MON',  1350, ' '],
                    ['TUE',  2450, '<?= Yii::$app->func->getTotalMoneyApproved() ?>'],
                    ['WED',  3550, '<?= Yii::$app->func->getTotalMoneyApproved() ?>'],
                    ['THU',  4650, '<?= Yii::$app->func->getTotalMoneyApproved() ?>'],
                    ['FRI',  7790, '<?= Yii::$app->func->getTotalMoneyApproved() ?>'],
                    ['SAT',  4680, '<?= Yii::$app->func->getTotalMoneyApproved() ?>'],
                    ['SUN',  4350, '<?= Yii::$app->func->getTotalMoneyApproved() ?>'],
                    ['MON',  4640, '<?= Yii::$app->func->getTotalMoneyOrders() ?>'],
                    ['TUE',  <?= Yii::$app->func->getTotalMoneyApproved() ?>, ' ']
                ]);

                var options = {
                    height: 314,
                    legend: 'none',
                    areaOpacity: 0.18,
                    axisTitlesPosition: 'out',
                    hAxis: {
                        title: '',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        textPosition: 'out'
                    },
                    vAxis: {
                        minValue: 0,
                        textPosition: 'out',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        baselineColor: '#16b4fc',
                        ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
                        gridlines: {
                            color: '#1ba0fc',
                            count: 15
                        },
                    },
                    lineWidth: 2,
                    colors: ['#fff'],
                    curveType: 'function',
                    pointSize: 5,
                    pointShapeType: 'circle',
                    pointFillColor: '#f00',
                    backgroundColor: {
                        fill: '#008ffb',
                        strokeWidth: 0,
                    },
                    chartArea:{
                        left:0,
                        top:0,
                        width:'100%',
                        height:'100%'
                    },
                    fontSize: 11,
                    fontName: 'Proxima Nova',
                    tooltip: {
                        trigger: 'selection',
                        isHtml: true
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(dataTable, options);
            }
            $(window).resize(function(){
                drawChart();
                setTimeout(function(){
                }, 1000);
            });
        });
    </script>