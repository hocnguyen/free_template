<div class="dropdown dropdown-notification messages">
	                        <a href="#"
	                           class="header-alarm dropdown-toggle active"
	                           id="dd-messages"
	                           data-toggle="dropdown"
	                           aria-haspopup="true"
	                           aria-expanded="false">
	                            <i class="font-icon-mail"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-messages" aria-labelledby="dd-messages">
	                            <div class="dropdown-menu-messages-header">
	                                <ul class="nav" role="tablist">
	                                    <li class="nav-item">
	                                        <a class="nav-link active"
	                                           data-toggle="tab"
	                                           href="#tab-incoming"
	                                           role="tab">
	                                            <?= Yii::t('app','UnRead') ?>
	                                            <span class="label label-pill label-danger">
	                                            	<?php $unread = \app\models\Contacts::find()->where('id_read =:id_read',[':id_read'=>0])->count();
                										echo $unread; ?>
	                                            </span>
	                                        </a>
	                                    </li>
	                                    <li class="nav-item">
	                                        <a class="nav-link"
	                                           data-toggle="tab"
	                                           href="#tab-outgoing"
	                                           role="tab"><?= Yii::t('app','Read') ?>
	                                           <span class="label label-pill">
	                                            	<?php $read = \app\models\Contacts::find()->where('id_read =:id_read',[':id_read'=>1])->count();
                										echo $read; ?>
	                                            </span>	
	                                        </a>
	                                    </li>
	                                </ul>
	                            </div>
	                            <div class="tab-content">
	                                <div class="tab-pane active" id="tab-incoming" role="tabpanel">
	                                    <div class="dropdown-menu-messages-list">
	                                    <?php 
	                                    	$data_message = \app\models\Contacts::find()->where('id_read =:id_read ORDER BY id DESC',[':id_read'=>0])->all();
	                                    	foreach ($data_message as $key=>$val) {
	                                    ?>
	                                        <a href="<?= Yii::$app->params['url_admin'] ?>/contacts/view?id=<?= $val->id ?>" class="mess-item">
	                                            <span class="avatar-preview avatar-preview-32"><img src="<?= Yii::getAlias('@back') ?>/img/avatar-2-32.png" alt=""></span>
	                                            <span class="mess-item-name"><?= $val->email ?></span>
	                                            <span class="mess-item-txt"><?= Yii::$app->func->limitStr($val->title, 75, '...') ?></span>
	                                        </a>
	                                     <?php } ?>   
	                                    </div>
	                                </div>
	                                <div class="tab-pane" id="tab-outgoing" role="tabpanel">
	                                    <div class="dropdown-menu-messages-list">
	                                    	<?php 
	                                    	$data_message_read = \app\models\Contacts::find()->where('id_read =:id_read ORDER BY id DESC',[':id_read'=>1])->all();
	                                    	foreach ($data_message_read as $val) {
	                                    ?>
	                                        <a href="<?= Yii::$app->params['url_admin'] ?>/contacts/view?id=<?= $val->id ?>" class="mess-item">
	                                            <span class="avatar-preview avatar-preview-32"><img src="<?= Yii::getAlias('@back') ?>/img/avatar-2-32.png" alt=""></span>
	                                            <span class="mess-item-name"><?= $val->email ?></span>
	                                            <span class="mess-item-txt"><?= Yii::$app->func->limitStr($val->title, 75, '...') ?></span>
	                                        </a>
	                                        <?php } ?>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="dropdown-menu-notif-more">
	                                <a href="<?= Yii::$app->params['url_admin'] ?>/contacts"><?= Yii::t('app','See more') ?></a>
	                            </div>
	                        </div>
	                    </div>