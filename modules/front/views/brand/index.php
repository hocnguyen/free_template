<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/16/17
 * Time: 10:59 PM
 */
error_reporting(0);
$this->title = $brand->name.' '.Yii::t('app','Brand');
$this->registerMetaTag(['name' => 'description', 'content' => $brand->name.','.\Yii::$app->func->makeAlias($brand->name).','.Yii::$app->params['site_name'] ]);
$this->registerMetaTag(['name' => 'keyword', 'content' => $brand->name.'-'.\Yii::$app->func->makeAlias($brand->name).'-'.Yii::$app->params['site_name'] ]);
?>

<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$brand->name]); ?> 
        <div class="row">
           <?=  yii\base\View::render('../elements/widget/left_menu', ['brand' => $brand]); ?> 
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?= $brand->name ?></span>
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
                                'itemView' => 'brand_view',
                                'summary'  =>'',
                        ] );?>
                        <?php \yii\widgets\Pjax::end(); ?>                   
                    </ul>
                </div> 
                    
            </div>
        </div>
    </div>
</div>