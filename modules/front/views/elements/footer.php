<?php 
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 5/22/17
 * Time: 10:16 PM
 */
use kartik\ipinfo\IpInfo;
use yii\helpers\Html;
?>
<aside id="sticky-social">
    <ul>
        <?php 
            $socials = \Yii::$app->func->getSocials();
            if( $socials ){
                foreach ($socials as $val){
            ?>
            <li><a href="<?= $val->social_link ?>" class="<?= $val->icon ?>" target="_blank"><span><?= Yii::t('app',$val->type) ?></span></a></li>
        <?php }} ?>
    </ul>
</aside>
<div class="footer">
    <div class="container">
        <div class="row">
        <div class="clear"></div>       
            <div class="col-md-12 footer-menu-web"> 
                <div class="heading-border"><?= Yii::t('app','Copyright') ?> © <?= Date('Y') ?> <?= Yii::t('app','{name}. All Rights Reserved.', ['name'=>Html::a('Top Theme Premium', 'http://'.Yii::$app->params['domain-company'])]) ?>
                    <span class="pull-right"><?= Yii::t('app','Development by Designwebvn.') ?></span>
                </div>
            </div> 

            <div id="footer-menu">
                <div  class="footer-menu-mobile">
                    <div class="col-md-3 col-xs-3"> 
                        <a href=""><img src="<?= Yii::getAlias('@front') ?>/images/f-home.png"></a>
                    </div> 
                    <div class="col-md-3 col-xs-3"> 
                        <a href=""><img src="<?= Yii::getAlias('@front') ?>/images/f-vip.png"></a>
                    </div>
                    <div class="col-md-3 col-xs-3"> 
                        <a href=""><img src="<?= Yii::getAlias('@front') ?>/images/f-share.png"></a>
                    </div>
                    <div class="col-md-3 col-xs-3"> 
                        <a href=""><img src="<?= Yii::getAlias('@front') ?>/images/f-account.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="scroll_top back-to-top" style="display: inline;">  
    <span class="arrow-up">
    <img src="<?= Yii::getAlias('@front') ?>/images/icon-scroll-arrow.png" alt=""></span>
    <img src="<?= Yii::getAlias('@front') ?>/images/icon-scroll-mouse.png" alt="">
</a>