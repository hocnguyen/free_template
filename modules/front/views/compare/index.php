<?php 
    use kartik\rating\StarRating;
    $this->title    = Yii::t('app', 'My Compare - My account');
    $subTitle       = Yii::t('app', 'My Compare');
    $data_compare = $products->getModels(); 
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$subTitle]); ?> 
        <h2 class="compare-heading">
            <span class="page-heading-title2"><?= $subTitle ?></span>
        </h2>
        <div class="row">
            <?=  yii\base\View::render('../elements/widget/left_menu_wishlist', []); ?>
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <?php 
                    if ($products->getCount() == 0) { ?>
                        <div class="msg-success msg">
                                <p>
                                    <?php echo Yii::t('app','Please add product for compare!') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                <?php    }
                ?>
            <table class="table table-bordered table-compare">
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Product Image') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                    <td>
                        <a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>"><img src="/<?= $val['image'] ?>" alt="$val['name']"></a>
                    </td>    
                    <?php } ?>             
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Product Name') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                        <td>
                            <a href="/detail/<?= $val['id'] ?>-<?= \Yii::$app->func->makeAlias($val['name']); ?>"><?= $val['name'] ?></a>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Rating') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                    <td>
                        <div class="product-star">
                            <?php 
                               echo StarRating::widget([
                                        'name'      => 'stats',
                                        'value'     => Yii::$app->func->getStatsRate($val['id']),
                                        'disabled'  => true
                                     ]);
    
                            ?>
                            <span>(<?= Yii::$app->func->getCountRate($val['id']) ?> <?= Yii::t('app','Reviews') ?>)</span>
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Price') ?></td>
                     <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                        <td class="price">
                            <div class="content_price">
                                <?php if($val['special_price']) ?>
                                    <span class="price product-price"><?= Yii::$app->func->formatPrice($val['special_price']) ?></span>
                                <span class="price <?= ($val['special_price'])?'old-price':'product-price' ?>"><?= Yii::$app->func->formatPrice($val['price']) ?></span>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Category') ?></td>
                     <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                      <td class="category-product"><?= Yii::$app->func->getProductCategories($val['id']) ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Manufacturer') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                    <td class="brand-product"><?= Yii::$app->func->getProductBrand($val['id']) ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Tags') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                    <td class="tags-product"><?= Yii::$app->func->getProductTags($val['id']) ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','SKU') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                        <td><?= $val['sku'] ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Description') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                    <td><?= $val['short_description'] ?></td>
                    <?php } ?>
                </tr>
              
                <tr>
                    <td class="compare-label"><?= Yii::t('app','Action') ?></td>
                    <?php 
                        foreach ($data_compare as $k=>$val) {    
                    ?>
                    <td class="action">
                        <a onclick="addCart('<?= $val['id'] ?>')" ><button class="add-cart button button-sm"><i class="fa fa-shopping-cart"></i></button> </a>
                        <a onclick="addWishlist('<?= $val['id'] ?>')" ><button class="button button-sm"><i class="fa fa-heart-o"></i></button></a>
                        <a onclick="removeCompare('<?= $val['id'] ?>')" ><button class="button button-sm"><i class="fa fa-close"></i></button></a>
                    </td>
                    <?php } ?>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="remove-compare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app','My Compare') ?></h4>
      </div>
      <div class="modal-body">
        <?= Yii::t('app','Are you sure you want to delete this item?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete-compare"><?= Yii::t('app','Delete') ?></button>
        <button type="button" data-dismiss="modal" class="btn btn-default"><?= Yii::t('app','Cancel') ?></button>
      </div>
    </div>
  </div>
</div>   