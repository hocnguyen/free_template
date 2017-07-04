<div class="dropdown dropdown-notification notif">
	                        <a href="#"
	                           class="header-alarm dropdown-toggle active"
	                           id="dd-notification"
	                           data-toggle="dropdown"
	                           aria-haspopup="true"
	                           aria-expanded="false">
	                            <i class="fa fa-users"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
	                            <div class="dropdown-menu-notif-header">
	                                <?= Yii::t('app','Customers') ?>
	                                <span class="label label-pill label-danger">
	                                	<?php 
	                                	$members = \app\models\User::find()->where('id_read =:id_read AND role =:role',[':id_read'=>0, ':role'=>10])->count();
                										echo $members; ?>
	                                </span>
	                            </div>
	                            <div class="dropdown-menu-notif-list">
	                            	<?php 
	                                    	$data_members = \app\models\User::find()->where('id_read =:id_read AND role =:role ORDER BY id DESC',[':id_read'=>0, ':role'=>10])->all();
	                                    	foreach ($data_members as $key=>$val) {
	                                 ?>
	                                <div class="dropdown-menu-notif-item">
		                                    <div class="photo">
		                                    	<?php
		                                    		if ($val->image) {
		                                    	 ?>
		                                    	 	<img style="border-radius: 50%; background:url('/<?= $val->image ?>');background-size:cover;background-position: center;" src="<?= Yii::getAlias('@back') ?>/img/blank.gif">
		                                    	<?php } else { ?>
		                                        <img src="<?= Yii::getAlias('@back') ?>/img/avatar-1-32.png" alt="<?= $val->lname ?>">
		                                        <?php } ?>
		                                    </div>
		                                    <div class="dot"></div>
		                                    <a href="<?= Yii::$app->params['url_admin'] ?>/user/view?id=<?= $val->id ?>"><?= $val->email ?></a>
		                                    <div class="color-blue-grey-lighter"><?= $val->fname." ".$val->lname ?> <br>
		                                    <?= $val->created ?>
		                                    </div>             
	                                </div>
	                                <?php } ?>
	                            </div>
	                            <div class="dropdown-menu-notif-more">
	                                <a href="<?= Yii::$app->params['url_admin'] ?>/user"><?= Yii::t('app','See more') ?></a>
	                            </div>
	                        </div>
	                    </div>