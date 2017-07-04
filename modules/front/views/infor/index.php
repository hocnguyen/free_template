<?php
    use yii\helpers\Html;
    use kartik\ipinfo\IpInfo;
    $this->title = 'My Information';
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Information']); ?>
        <div class="row">
            <?=  yii\base\View::render('../elements/widget/left_menu_wishlist', []); ?>
             <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title2"><?= Yii::t('app','My Information') ?></span>
                    </h2>
                    <div class="page-content">
                        <div class="information-customer">
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
            </div>
            </div>        
        </div>
    </div>
</div>