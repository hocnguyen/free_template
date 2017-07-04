 <?php 
    use kartik\rating\StarRating;
?>
 <li class="col-sx-12 col-sm-4">
                            <div class="product-container">
                                <div class="left-block">
                                    <a href="/detail/<?= $model['id'] ?>-<?= \Yii::$app->func->makeAlias($model['name']); ?>">
                                        <img class="img-responsive" alt="<?= $model['name']  ?>" src="/<?= $model['image'] ?>"/>
                                    </a>
                                    <div class="quick-view">
                                            <a title="<?= Yii::t('app','Add to compare') ?>" class="compare" href="#"></a>
                                            <a title="<?= Yii::t('app','Add to Cart') ?>" class="search" onclick="addCart('<?= $model['id'] ?>')"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="<?= Yii::t('app','Quick view') ?>" href="/detail/<?= $model['id'] ?>-<?= \Yii::$app->func->makeAlias($model['name']); ?>"><?= Yii::t('app','Quick view') ?></a>
                                    </div>
                                    <div class="group-price pos-wishlist">
                                        <a onclick="removeWishlist('<?= $model['id'] ?>')"> <span class="del-wishlist glyphicon glyphicon-trash" aria-hidden="true"></span> </a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="/detail/<?= $model['id'] ?>-<?= \Yii::$app->func->makeAlias($model['name']); ?>"><?= $model['name']  ?></a></h5>
                                    <div class="product-star">
                                        <?php 
                                               echo StarRating::widget([
                                                        'name'      => 'stats',
                                                        'value'     => Yii::$app->func->getStatsRate($model['id']),
                                                        'disabled'  => true
                                                     ]);
    
                                            ?>
                                    </div>
                                    <div class="content_price">
                                        <?php if($model['special_price']) ?>
                                                    <span class="price product-price"><?= Yii::$app->func->formatPrice($model['special_price']) ?></span>
                                                <span class="price <?= ($model['special_price'])?'old-price':'product-price' ?>"><?= Yii::$app->func->formatPrice($model['price']) ?></span>
                                    </div>
                                    <div class="info-orther">
                                        <p><?= Yii::t('app','Item Code') ?>: #<?= $model['sku'] ?></p>
                                        <div class="product-desc">
                                            <?= $model['short_description'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
<?=  yii\base\View::render('../elements/widget/popup_confirm_delete', ['title' => Yii::t('app','My Wishlist')]); ?>                                              