    <div class="row">
	                    <div class="col-sm-6">
	                        <article class="statistic-box red">
	                            <div>
	                                <div class="number">
	                                <?php
                							$orders = \app\models\Orders::find()->where('1')->count();
                							echo $orders;
            						?>
            						</div>
	                                <div class="caption"><div><?= Yii::t('app','Orders') ?></div></div>
	                                <div class="percent">
	                                    <div class="arrow up"></div>
	                                    <p>15%</p>
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number">
	                                	<?php
                							$customers = \app\models\User::find()->where('role =:role',[':role' => 10])->count();
                							echo $customers;
            							?>
	                                </div>
	                                <div class="caption"><div><?= Yii::t('app','Customers') ?></div></div>
	                                <div class="percent">
	                                    <div class="arrow up"></div>
	                                    <p>11%</p>
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number">
	                                	<?php
                							$products = \app\models\Products::find()->where('1')->count();
                							echo $products;
            							?>	
	                                </div>
	                                <div class="caption"><div><?= Yii::t('app','Products') ?></div></div>
	                                <div class="percent">
	                                    <div class="arrow down"></div>
	                                    <p>5%</p>
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
	                        <article class="statistic-box green">
	                            <div>
	                                <div class="number"><?php
                						$contacts = \app\models\Contacts::find()->where('1')->count();
                						echo $contacts;
            					?></div>
	                                <div class="caption"><div><?= Yii::t('app','Contacts') ?></div></div>
	                                <div class="percent">
	                                    <div class="arrow up"></div>
	                                    <p>20%</p>
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                </div><!--.row-->