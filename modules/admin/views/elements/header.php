<?php 
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use kartik\ipinfo\IpInfo;
?>
<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="<?= Yii::$app->params['url_admin'] ?>" class="site-logo">
	            <img class="hidden-md-down" src="<?= Yii::getAlias('@back') ?>/img/logo-2.png" alt="">
	            <img class="hidden-lg-up" src="<?= Yii::getAlias('@back') ?>/img/logo-2-mob.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span><?= Yii::t('app','toggle menu') ?></span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span><?= Yii::t('app','toggle menu') ?></span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <?php echo yii\base\View::render('../elements/dashboard/notification'); ?>
	                    <?php echo yii\base\View::render('../elements/dashboard/messages'); ?>	                    
						<?php echo yii\base\View::render('../elements/languages'); ?>
	                    <div class="dropdown user-menu">
	                    	<?php 
	                    		$user = \app\models\User::findOne(\Yii::$app->user->id);
	                    		$profile = isset($user->image)?'/'.$user->image:Yii::getAlias('@back').'/img/avatar-2-64.png';
	                    	?>
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        	 <img style="border-radius: 50%; background:url('<?= $profile ?>');background-size:cover;background-position: center;" class="thumb-img" src="<?= Yii::getAlias('@back') ?>/img/blank.gif">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="<?= Yii::$app->params['url_admin'] ?>/user/view?id=<?= \Yii::$app->user->id ?>"><span class="font-icon glyphicon glyphicon-user"></span><?= Yii::t('app','Profile')." ".\Yii::$app->user->identity->username ?></a>
	                            <a class="dropdown-item" href="<?= Yii::$app->params['url_admin'] ?>/user/admin"><span class="font-icon glyphicon glyphicon-cog"></span><?= Yii::t('app','Settings') ?></a>
	                            <a class="dropdown-item" href="<?= Yii::$app->params['url_admin'] ?>/user/changepass"><span class="font-icon glyphicon glyphicon-edit"></span><?= Yii::t('app','Change password') ?></a>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="/logout" data-method="post"><span class="font-icon glyphicon glyphicon-log-out"></span><?= Yii::t('app','Logout') ?></a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                <div class="site-header-collapsed">
	                    <div class="site-header-collapsed-in">
	                        <div class="dropdown dropdown-typical">
	                         
	                        </div>
	                        <div class="dropdown dropdown-typical">
	                            <a class="dropdown-toggle" id="dd-header-marketing" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                                <span class="fa fa-info-circle" style="font-size: 1.5em; padding-top: 2px; color:#adb7be;"></span>
	                                <span class="lbl"><?= Yii::t('app','IP Information') ?></span>
	                            </a>
	
	                            <div class="dropdown-menu" style="width: 255px !important;" aria-labelledby="dd-header-marketing">
	                             <?= 
                           	   		 IpInfo::widget([
									    'showPopover' => false,  
									    'showFlag' => false,
									    'contentOptions' => [
									        'class' => 'table table-bordered table-striped'
									    ],
									]);
	                            ?>      
	                            </div>
	                        </div>
	                    </div><!--.site-header-collapsed-in-->
	                </div><!--.site-header-collapsed-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header>