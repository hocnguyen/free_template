<?php 
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
?>
<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	   <div class="side-menu-avatar">
	        <div class="avatar-preview avatar-preview-100">
	           <?php 
            		$user = \app\models\User::findOne(\Yii::$app->user->id);
            		$profile = isset($user->image)?'/'.$user->image:Yii::getAlias('@back').'/img/avatar-1-256.png';
	            ?>
	           <img style="border-radius: 50%; background:url('<?= $profile ?>');background-size:cover;background-position: center;" class="thumb-img" src="<?= Yii::getAlias('@back') ?>/img/blank.gif">
	        </div>
	    </div>
	    <ul class="side-menu-list">
	        <li class="grey <?= Yii::$app->controller->id == 'index'? 'active_menu': '' ?>">
	        <a href="<?= Yii::$app->params['url_admin'] ?>">
	            <span>
	                <i class="fa fa-home"></i>
	                <span class="lbl"><?= Yii::t('app','Dashboard') ?> </span>
	            </span>
	        </a>    
	        </li>
	        <li class="blue-dirty with-sub <?= \Yii::$app->func->addClassMenuCatalog(Yii::$app->controller->id) ?>">
	            <span>
	                <i class="fa fa-product-hunt"></i>
	                <span class="lbl"><?= Yii::t('app','Catalog') ?></span>
	            </span>
	            <ul>
	            	<?php 
	            	    foreach (Yii::$app->params['sub_menu_catalog'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }             	
	            	?>                 
	            </ul>
	        </li>
	        <li class="purple with-sub <?= \Yii::$app->func->addClassMenuOrders(Yii::$app->controller->id) ?>">
	            <span>
	                <i class="glyphicon glyphicon-shopping-cart active"></i>
	                <span class="lbl"><?= Yii::t('app','Sales') ?></span>
	                <?php 
	                 $sales = \app\models\Orders::find()->where('id_read =:id_read',[':id_read'=>0])->count();
	                 if( $sales > 0 ) { ?>
	                	<span class="label label-custom label-pill label-danger"><?= $sales ?></span>
	                <?php } ?>
	            </span>
	            <ul>
	                <?php 
	            		foreach (Yii::$app->params['sub_menu_sales'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }             	
	            	?>      
	            </ul>
	        </li>
	        <li class="gold with-sub <?= \Yii::$app->func->addClassMenuCustomers(Yii::$app->controller->id, Yii::$app->controller->action->id) ?>">
	            <span>
	                <i class="fa fa-users"></i>
	                <span class="lbl"><?= Yii::t('app','Customers') ?></span>
	                <?php 
	                 $customers = \app\models\User::find()->where('id_read =:id_read AND role =:role',[':id_read'=>0, ':role' => 10])->count();
	                 if( $customers > 0 ) { ?>
	                	<span class="label label-custom label-pill label-danger"><?= $customers ?></span>
	                <?php } ?>
	             </span>
	             <ul>
	                <?php 
	            		foreach (Yii::$app->params['sub_menu_customers'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }             	
	            	?>      
	            </ul>
	        </li>
	        <li class="blue with-sub <?= \Yii::$app->func->addClassMenuStatistics(Yii::$app->controller->id) ?>">
	            <span>
	                <i class="fa fa-bar-chart-o"></i>
	                <span class="lbl"><?= Yii::t('app','Statistics') ?></span>
	            </span>
	            <ul>
	                <?php 
	            		foreach (Yii::$app->params['sub_menu_stats'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }             	
	            	?>
	            </ul>
	        </li>

	        <li class="green with-sub <?= \Yii::$app->func->addClassMenuPosts(Yii::$app->controller->id) ?>">
	            <span>
	                <span class="fa fa-newspaper-o"></span>
	                <span class="lbl"><?= Yii::t('app','Posts') ?></span>
	            </span>
	            <ul>
	                 <?php 
	            		foreach (Yii::$app->params['sub_menu_news'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }   ?> 

	            </ul>
	        </li>	        
	      
	        <li class="grey with-sub <?= \Yii::$app->func->addClassMenuConfiguration(Yii::$app->controller->id) ?>">
	            <span>
	                <span class="font-icon font-icon-cogwheel"></span>
	                <span class="lbl"><?= Yii::t('app','Configuration') ?></span>
	            </span>
	            <ul>
	                <?php 
	            		foreach (Yii::$app->params['sub_menu_configuration'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }             	
	            	?>
	            </ul>
	        </li>

	        <li class="orange-red with-sub <?= \Yii::$app->func->addClassMenuPromotions(Yii::$app->controller->id) ?>">
	            <span>
	                <i class="fa fa-money"></i>
	                <span class="lbl"><?= Yii::t('app','Promotions') ?></span>
	            </span>
	            <ul>
	            	<?php 
	            		foreach (Yii::$app->params['sub_menu_promotions'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }             	
	            	?>
	            </ul>
	        </li>
	        <?php
                $contacts = \app\models\Contacts::find()->where('id_read =:id_read',[':id_read'=>0])->count();
            ?>
	        <li class="red <?= Yii::$app->controller->id == 'contacts'? 'active_menu': '' ?>">
	            <a href="<?= Yii::$app->params['url_admin'] ?>/contacts" class="label-right">
	                <i class="font-icon font-icon-contacts"></i>
	                <span class="lbl"><?= Yii::t('app','Contacts') ?></span>
	                <?php  if( $contacts > 0 ) { ?>
	                	<span class="label label-custom label-pill label-danger"><?= $contacts ?></span>
	                <?php } ?>
	            </a>
	        </li>
	         <li class="blue with-sub <?= \Yii::$app->func->addClassMenuProfile(Yii::$app->controller->id, Yii::$app->controller->action->id) ?>">
	            <span>
	                <i class="font-icon font-icon-user"></i>
	                <span class="lbl"><?= Yii::t('app','Profile') ?></span>
	            </span>
	            <ul>
	               <?php 
	            		foreach (Yii::$app->params['sub_menu_profile'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id.'/'.Yii::$app->controller->action->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }   ?> 
	            </ul>
	        </li>
	        <li class="purple with-sub <?= \Yii::$app->func->addClassMenuSystem(Yii::$app->controller->id) ?>">
	            <span>
	                <span class="glyphicon glyphicon-globe"></span>
	                <span class="lbl"><?= Yii::t('app','System') ?></span>
	            </span>
	            <ul>
	                <?php 
	            		foreach (Yii::$app->params['sub_menu_system'] as $key => $value) {
	            	?>	
	            		<li <?= $key == Yii::$app->controller->id? Yii::$app->params['class_side_menu'] : "" ?> ><a href="<?= Yii::$app->params['url_admin'] ?>/<?= $key ?>"><span class="lbl"><?= Yii::t('app',$value) ?></span></a></li>
	            	<?php }   ?> 
	            </ul>
	        </li>
	    </ul>
	</nav>