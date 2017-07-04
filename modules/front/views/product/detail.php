<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/10/17
 * Time: 10:24 PM
 */
error_reporting(0);
$this->title = $data->name;
$this->registerMetaTag(['name' => 'description', 'content' => $data->name.','.\Yii::$app->func->makeAlias($data->name).','.Yii::$app->params['site_name'] ]);
$this->registerMetaTag(['name' => 'keyword', 'content' => $data->name.'-'.\Yii::$app->func->makeAlias($data->name).'-'.Yii::$app->params['site_name'] ]);
use yii\helpers\Html;
use kartik\rating\StarRating;
use bigpaulie\social\share\Share;
?>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Return to Home"><?= Yii::t('app','Home') ?></a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page"><?= $data->name ?></span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                    <div id="product">
                        <div class="primary-box row">
                            <div class="pb-left-column col-xs-12 col-sm-5">
                                <div class="product-image">
                                    <div class="product-full">

                                        <img id="product-zoom" src='/<?= $data->image ?>' data-zoom-image="/<?= $data->image ?>"/>
                                    </div>
                                    <div class="product-img-thumb" id="gallery_01">
                                        <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="21" data-loop="false">
                                            <li>
                                                <a href="#" data-image="/<?= $data->image ?>" data-zoom-image="/<?= $data->image ?>">
                                                    <img id="product-zoom"  src="/<?= $data->image ?>" /> 
                                                </a>
                                            </li>
                                            <?php foreach ($data_img as $val) {
                                             ?>
                                            <li>
                                                <a href="#" data-image="/<?= $val['image_path'] ?>" data-zoom-image="/<?= $val['image_path'] ?>">
                                                    <img id="product-zoom"  src="/<?= $val['image_path'] ?>" /> 
                                                </a>
                                            </li>
                                            <?php } ?>                      
                                        </ul>
                                    </div>
                                </div>
                                <!-- product-imge-->
                            </div>
                            <div class="pb-right-column col-xs-12 col-sm-7">
                                <h1 class="product-name"><?= $data->name ?></h1>
                                <?php if (count($feedback) > 0) { ?>
                                    <div class="product-comments">
                                        <div class="product-star">
                                            <?php 
                                               echo StarRating::widget([
                                                        'name'      => 'stats',
                                                        'value'     => Yii::$app->func->getStatsRate($data->id),
                                                        'disabled'  => true
                                                     ]);
    
                                            ?>
                                        </div>
                                        <div class="comments-advices">
                                            <a href="#reviews"><?= Yii::t('app', 'Based  on {total_feedback} ratings', ['total_feedback' => count($feedback)]) ?> </a>
                                            <a href="/feedback"><i class="fa fa-pencil"></i> <?= Yii::t('app','write a review') ?></a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="product-price-group">
                                     <?php if($data->special_price) ?>
                                        <span class="price"><?= Yii::$app->func->formatPrice($data->special_price) ?></span>
                                    <span class="<?= ($data->special_price)?'old-price':'price' ?>"><?= Yii::$app->func->formatPrice($data->price) ?></span>
                                </div>
                                <div class="info-orther">
                                    <p><?= Yii::t('app','Item Code') ?>: #<?= $data->sku ?></p>
                                    <p><?= Yii::t('app','Categories') ?>: <span class="in-stock"><?= Yii::$app->func->getProductCategories($data->id) ?></span></p>
                                    <p><?= Yii::t('app','Brand') ?>: <?= Yii::$app->func->getProductBrand($data->id) ?></p>
                                    <p><?= Yii::t('app','Tags') ?>: <?= Yii::$app->func->getProductTags($data->id) ?></p>
                                </div>
                                <div class="product-desc">
                                     <?= $data->short_description ?>
                                </div>
                                <div class="form-option">
                                    <p class="form-option-title"><?= Yii::t('app','Available Options') ?>:</p>
                                    <div class="attributes">
                                        <div class="attribute-label"><?= Yii::t('app','Qty') ?>:</div>
                                        <div class="attribute-list product-qty">
                                            <div class="qty">
                                                <input id="option-product-qty" type="number" value="1" min="1" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onchange="checkIn()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-action">
                                    <div class="button-group">
                                        <?php if(Yii::$app->session['total_cart'] > 0) { ?>
                                            <a class="buy-now-btn" onclick="buyNow('<?= $data->id ?>')"><?= Yii::t('app','Buy Now') ?></a>
                                        <?php } ?>
                                        <a class="btn-add-cart" onclick="addCartDetail('<?= $data->id ?>')"><?= Yii::t('app','Add to cart') ?></a>
                                    </div>
                                    <div class="button-group">
                                        <a class="wishlist" onclick="addWishlist('<?= $data->id ?>')"><i class="fa fa-heart-o"></i>
                                        <br><?= Yii::t('app','Wishlist') ?></a>
                                        <a class="compare" onclick="addCompare('<?= $data->id ?>')"><i class="fa fa-signal"></i>
                                        <br>        
                                        <?= Yii::t('app','Compare') ?></a>
                                    </div>
                                </div>
                                <div class="form-share">
                                    <div class="network-share">
                                        <?php echo Share::widget(); ?>
                                        <ul> <li><a href="javascript:print();"><i class="fa fa-print"></i> <?= Yii::t('app','Print') ?></a></li> </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tab product -->
                        <div class="product-tab">
                            <ul class="nav-tab">
                                <li class="active">
                                    <a aria-expanded="false" data-toggle="tab" href="#product-detail"><?= Yii::t('app','Product Details') ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews"><?= Yii::t('app','Feedback') ?> (<?= count($feedback) ?>) </a>
                                </li>
                                <li>
                                    <a aria-expanded="true" data-toggle="tab" href="#information"><?= Yii::t('app','Seller Guarantees') ?></a>
                                </li>              
                            </ul>
                            <div class="tab-container">
                                <div id="product-detail" class="tab-panel active">
                                    <?= $data->full_dsscription ?>
                                </div>
                                
                                <div id="reviews" class="tab-panel">
                                    <div class="product-comments-block-tab">
                                       <?php
                                            foreach ($feedback as $f=>$fb) {
                                        ?>
                                        <div class="comment row">
                                            <div class="col-sm-3 author">
                                                <div class="grade">
                                                    <?php 
                                                       echo StarRating::widget([
                                                                'name' => 'rate',
                                                                'value' => $fb->rate,
                                                                'disabled' => true
                                                             ]);
                                                    ?>
                                                </div>
                                                <div class="info-author">
                                                    <span><strong><?php $user_feedback = Yii::$app->func->getUser($fb->member_id); echo $user_feedback->fname.' '.$user_feedback->lname ?></strong></span>
                                                    <em><?= $fb->created ?></em>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 commnet-dettail">
                                                <?= $fb->comment ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <p>
                                            <a class="btn-comment" href="/feedback"><?= Yii::t('app','Write your review !') ?></a>
                                            <div class="description-feedback">
                                            <?= Yii::$app->func->getHtmlPage('product_feedback'); ?>
                                            </div>
                                        </p>
                                    </div>              
                                </div>

                                <div id="information" class="tab-panel">
                                    <?= 
                                         Yii::$app->func->getHtmlPage('seller_guarantees');      
                                    ?>
                                    <h3 class="buyer_protection"><?= Yii::t('app','Buyer Protection') ?></h3>
                                    <?= 
                                        Yii::$app->func->getHtmlPage('buyer_protection');
                                    ?>
                                </div>
                            </div>
                        </div>
                            <?php 
                            if (count($products) > 0) { 
                                echo yii\base\View::render('../elements/widget/relate_products', ['title' => Yii::t('app','Related Products'),'products' => $products]);
                            }     

                            if (count($likedproducts) > 0) {
                               echo yii\base\View::render('../elements/widget/relate_products', ['title' => Yii::t('app','You might also like'),'products' => $likedproducts]);
                            }
                            ?>
                    </div>
            </div>
        </div>
    </div>
</div>