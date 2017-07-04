<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/11/17
 * Time: 11:59 PM
 */
error_reporting(0);
$this->title = $category->name;
$this->registerMetaTag(['name' => 'description', 'content' => $category->name.','.\Yii::$app->func->makeAlias($category->name).','.Yii::$app->params['site_name'] ]);
$this->registerMetaTag(['name' => 'keyword', 'content' => $category->name.'-'.\Yii::$app->func->makeAlias($category->name).'-'.Yii::$app->params['site_name'] ]);
?>

<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$category->name]); ?> 
        <div class="row">
           <?=  yii\base\View::render('../elements/widget/left_menu', ['category'=> $category]); ?> 
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?= $category->name ?></span>
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
                                'itemView' => 'category_view',
                                'summary'  =>'',
                        ] );?>
                        <?php \yii\widgets\Pjax::end(); ?>                   
                    </ul>
                </div> 
                    <?php  //yii\base\View::render('../elements/widget/sort_bar'); ?>       
            </div>
        </div>
    </div>
</div>