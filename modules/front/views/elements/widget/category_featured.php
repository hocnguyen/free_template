<?php 
     use kartik\rating\StarRating;
?>
        <div class="category-featured option<?= $elevator ?>">
            <nav class="navbar nav-menu nav-menu-<?= $color ?> show-brand">
              <div class="container">
                  <div class="navbar-brand">
                  <?php 
                    $parent_cate = app\models\Categories::findOne($parent);
                  ?>
                  <a href="/category/<?= $parent ?>-<?= Yii::$app->func->makeAlias($parent_cate->name) ?>"><img alt="fashion" src="<?= Yii::getAlias('@uploads') ?>/categories/<?= $parent_cate->image ?>" /><?= $parent_cate->name ?></a></div>
                  <span class="toggle-menu"></span>
                <div class="collapse navbar-collapse">           
                  <ul class="nav navbar-nav">
                  <li class="active"><a data-toggle="tab" href="#tab-<?= $start ?>"><?= Yii::t('app','New') ?></a></li>
                    <?php 
                        $t = $start;
                        $subCategories = Yii::$app->func->getSubCategoriesHaveProducts($parent);
                        foreach ($subCategories as $key=>$val) {
                        $t += 1;
                    ?>
                  <li><a data-toggle="tab" href="#tab-<?= $t ?>"><?= $val['name'] ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div id="elevator-<?= $elevator ?>" class="floor-elevator">
                    <a href="#elevator-<?= $elevator - 1 ?>" class="btn-elevator up <?= $elevator == 1?'disabled':'' ?> fa fa-angle-up"></a>
                    <a href="#elevator-<?= $elevator + 1 ?>" class="btn-elevator down <?= $elevator == 6?'disabled':'' ?> fa fa-angle-down"></a>
              </div>
            </nav>
            <div class="category-banner">
                <?php 
                    $banners_category = Yii::$app->func->getBannersCategory($parent, 1);
                    if($banners_category) {
                    foreach ($banners_category as $k=>$v) {
                ?>
                    <div class="col-sm-6 banner">
                        <a href="<?= $v->link ?>"><img alt="<?= $v->name ?>" class="img-responsive" src="<?= Yii::getAlias('@uploads') ?>/advertising/<?= $v->image ?>" /></a>
                    </div>
                <?php } } ?>
           </div>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <div class="featured-text"><span><?= Yii::t('app','featured') ?></span></div>
                    <div class="banner-img">
                        <?php 
                            $banners_category_left = Yii::$app->func->getBannersCategory($parent, 4);
                            if($banners_category_left) {
                            foreach ($banners_category_left as $l) {
                        ?>
                        <a href="<?= $l->link ?>"><img alt="<?= $l->name ?>" src="<?= Yii::getAlias('@uploads') ?>/advertising/<?= $l->image ?>" /></a>
                        <?php } } ?>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <div class="tab-panel active" id="tab-<?= $start ?>">
                                <ul class="product-list owl-carousel"  data-dots="false" data-loop="false" data-nav="true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php
                                        $new_product = Yii::$app->func->getProductsbyCategoryIndex($parent); 
                                        foreach ($new_product as $key=>$val ){
                                    ?>
                                    <li>
                                        <div class="left-block">
                                            <a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>">
                                                <img class="img-responsive" alt="<?= $val['name'] ?>" src="<?= $val['image'] ?>" />
                                            </a>
                                            <div class="quick-view">
                                                    <a title="<?= Yii::t('app','Add to my wishlist') ?>" class="heart" onclick="addWishlist('<?= $val['id'] ?>')"></a>
                                                    <a title="<?= Yii::t('app','Add to compare') ?>" class="compare" onclick="addCompare('<?= $val['id'] ?>')"></a>
                                                    <a title="<?= Yii::t('app','Add to Cart') ?>" class="search" onclick="addCart('<?= $val['id'] ?>')"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="<?= Yii::t('app','Quick view') ?>" href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>" ><?= Yii::t('app','Quick view') ?></a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                             <h5 class="product-name"><a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>"><?= Yii::$app->func->limitStr($val['name'], 60) ?></a></h5>
                                            <div class="content_price">
                                                <?php if($val['special_price']) ?>
                                                    <span class="price product-price"><?= Yii::$app->func->formatPrice($val['special_price']) ?></span>
                                                <span class="price <?= ($val['special_price'])?'old-price':'product-price' ?>"><?= Yii::$app->func->formatPrice($val['price']) ?></span>
                                            </div>
                                            <div class="product-star">
                                                <?php 
                                                    if (Yii::$app->func->getCountRate($val['id']) > 0 ) {
                                                       echo StarRating::widget([
                                                                'name'      => 'category_1',
                                                                'value'     => Yii::$app->func->getStatsRate($val['id']),
                                                                'disabled'  => true,
                                                                'pluginOptions' => ['displayOnly' => true]
                                                             ]);
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>     

                            <?php 
                                $t = $start;
                                $subCategories = Yii::$app->func->getSubCategoriesHaveProducts($parent);
                                foreach ($subCategories as $key=>$val) {
                                $t += 1;
                            ?>
                            <div class="tab-panel" id="tab-<?= $t ?>">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php
                                        $new_product = Yii::$app->func->getProductsbyCategoryIndex($val['id']); 
                                        foreach ($new_product as $key=>$val ){
                                    ?>
                                        <li>
                                        <div class="left-block">
                                            <a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>">
                                                <img class="img-responsive" alt="<?= $val['name'] ?>" src="<?= $val['image'] ?>" />
                                            </a>
                                            <div class="quick-view">
                                                    <a title="<?= Yii::t('app','Add to my wishlist') ?>" class="heart" onclick="addWishlist('<?= $val['id'] ?>')"></a>
                                                    <a title="<?= Yii::t('app','Add to compare') ?>" class="compare" onclick="addCompare('<?= $val['id'] ?>')"></a>
                                                    <a title="<?= Yii::t('app','Add to Cart') ?>" class="search" onclick="addCart('<?= $val['id'] ?>')"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="<?= Yii::t('app','Quick view') ?>" href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>" ><?= Yii::t('app','Quick view') ?></a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                             <h5 class="product-name"><a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>"><?= Yii::$app->func->limitStr($val['name'], 60) ?></a></h5>
                                            <div class="content_price">
                                                <?php if($val['special_price']) ?>
                                                    <span class="price product-price"><?= Yii::$app->func->formatPrice($val['special_price']) ?></span>
                                                <span class="price <?= ($val['special_price'])?'old-price':'product-price' ?>"><?= Yii::$app->func->formatPrice($val['price']) ?></span>
                                            </div>
                                            <div class="product-star">
                                                <?php 
                                                    if (Yii::$app->func->getCountRate($val['id']) > 0 ) {
                                                       echo StarRating::widget([
                                                                'name'      => 'category_1',
                                                                'value'     => Yii::$app->func->getStatsRate($val['id']),
                                                                'disabled'  => true,
                                                                'pluginOptions' => ['displayOnly' => true]
                                                             ]);
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
           </div>
        </div>