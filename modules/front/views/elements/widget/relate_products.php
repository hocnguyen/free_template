 <?php 
    use kartik\rating\StarRating;
?>
   <div class="page-product-box">
                            <h3 class="heading"><?= $title ?></h3>
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                <?php foreach ($products as $key=>$val) { ?>
                                <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>">
                                                <img class="img-responsive" alt="<?= $val['name'] ?>" src="/<?= $val['image'] ?>" />
                                            </a>
                                            <div class="quick-view">
                                                    <a title="<?= Yii::t('app','Add to my wishlist') ?>" class="heart" onclick="addWishlist('<?= $val['id'] ?>')"></a>
                                                    <a title="<?= Yii::t('app','Add to compare') ?>" class="compare" onclick="addCompare('<?= $val['id'] ?>')"></a>
                                                    <a title="<?= Yii::t('app','Add to Cart') ?>" class="search" onclick="addCart('<?= $val['id'] ?>')"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="<?= Yii::t('app','Quick view') ?>" href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>"><?= Yii::t('app','Quick view') ?></a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>"><?= $val['name'] ?></a></h5>
                                            <div class="product-star">
                                                <?php 
                                                    if (Yii::$app->func->getCountRate($val['id']) > 0 ) {
                                                       echo StarRating::widget([
                                                                'name'      => 'related',
                                                                'value'     => Yii::$app->func->getStatsRate($val['id']),
                                                                'disabled'  => true,
                                                                'pluginOptions' => ['displayOnly' => true]
                                                             ]);
                                                    } 
                                                ?>
                                            </div>
                                            <div class="content_price">
                                                <?php if($val['special_price']) ?>
                                                    <span class="price product-price"><?= Yii::$app->func->formatPrice($val['special_price']) ?></span>
                                                <span class="price <?= ($val['special_price'])?'old-price':'product-price' ?>"><?= Yii::$app->func->formatPrice($val['price']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                             </li> 
                             <?php } ?>                           
                            </ul>
                        </div>