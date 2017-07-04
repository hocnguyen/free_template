<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/11/17
 * Time: 11:59 PM
 */
error_reporting(0);
$this->title = Yii::t('app', 'Best selling products');
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.','.\Yii::$app->func->makeAlias($this->title).','.Yii::$app->params['site_name'] ]);
$this->registerMetaTag(['name' => 'keyword', 'content' => $this->title.'-'.\Yii::$app->func->makeAlias($this->title).'-'.Yii::$app->params['site_name'] ]);
?>

<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <div class="row">
           <?=  yii\base\View::render('../elements/widget/left_menu'); ?> 
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?= $this->title ?></span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span><?= Yii::t('app','grid') ?></span>
                        </li>
                        <li class="view-as-list">
                            <span><?= Yii::t('app','list') ?></span>
                        </li>
                    </ul>
                    <ul class="row product-list grid" id="best-selling">     
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$products,
                                'itemView' => 'best_view',
                                'summary'  =>'',
                        ] );?>                 
                    </ul>
                </div> 
            </div>
        </div>
    </div>
</div>