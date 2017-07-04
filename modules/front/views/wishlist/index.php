<?php 
    $this->title    = Yii::t('app', 'My wishlist - My account');
    $subTitle       = Yii::t('app', 'My wishlist');
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$subTitle]); ?>  
        <div class="row">
            <?=  yii\base\View::render('../elements/widget/left_menu_wishlist', []); ?>
             <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?= $subTitle ?></span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span><?= Yii::t('app','grid') ?></span>
                        </li>
                        <li class="view-as-list">
                            <span><?= Yii::t('app','list') ?></span>
                        </li>
                    </ul>
                    <ul class="row product-list grid">
                        <?php \yii\widgets\Pjax::begin(); ?>
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$products,
                                'itemView' => 'wishlist_view',
                                'summary'  =>'',
                        ] );?>
                        <?php \yii\widgets\Pjax::end(); ?>                   
                    </ul>
                </div>     
            </div>
        </div>
        <!-- ./row-->
    </div>
</div>