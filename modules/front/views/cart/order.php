<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/10/17
 * Time: 10:24 PM
 */
$this->title = "Your shopping cart";
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.','.Yii::$app->params['site_name'] ]);
$this->registerMetaTag(['name' => 'keyword', 'content' => $this->title.'-'.Yii::$app->params['site_name'] ]);
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Your shopping cart']); ?> 
        <h2 class="page-heading no-line">
            <span class="page-heading-title2"><?= Yii::t('app','Shopping Cart Summary') ?></span>
        </h2>
        <div class="page-content page-order">
            <div class="heading-counter warning"><?= Yii::t('app','Your shopping cart contains') ?>:
                <span><?= (Yii::$app->session['total_cart'])?Yii::$app->session['total_cart']:0; ?> <?= Yii::$app->session['total_cart'] > 1 ?Yii::t('app','Products'):Yii::t('app','Product') ?></span>
            </div>
            <div class="order-detail-content">
                <table class="table table-bordered table-responsive cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product"><?= Yii::t('app','Product') ?></th>
                            <th><?= Yii::t('app','Description') ?></th>
                            <th><?= Yii::t('app','Unit price') ?></th>
                            <th><?= Yii::t('app','Qty') ?></th>
                            <th><?= Yii::t('app','Total') ?></th>
                            <th  class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       if (Yii::$app->session['cart']) {
                       foreach (Yii::$app->session['cart'] as $key => $value) { 
                            $product                = \app\models\Products::findone($key);
                            $price_product          = ($product->special_price)?$product->special_price:$product->price;
                            $total_money_by_product = $value['qty'] * $price_product;
                        ?>     
                        <tr>
                            <td class="cart_product">
                                <a href="/detail/<?= $product->id ?>-<?= Yii::$app->func->makeAlias($product->name) ?>"><img src="<?= $product->image ?>" alt="<?= $product->name ?>"></a>
                            </td>
                            <td class="cart_description">
                                <p class="product-name"><a href="/detail/<?= $product->id ?>-<?= Yii::$app->func->makeAlias($product->name) ?>"><?= $product->name ?></a></p>
                                <small class="cart_ref"><?= Yii::t('app','SKU') ?> : #<?= $product->sku ?></small><br>
                            </td>
                            <td class="price">
                                <?php if($product->special_price){ ?>
                                    <div class="sale-price"><?= Yii::$app->func->formatPrice($price_product) ?></div>
                                    <div class="retail-price"><?= Yii::$app->func->formatPrice($product->price) ?></div>
                                <?php } else { ?>
                                    <span class="sale-price"><?= Yii::$app->func->formatPrice($product->price) ?></span>
                                <?php } ?>        
                            </td>
                            <td class="qty">
                                <input id="qty_<?= $key ?>" class="form-control input-sm" type="number" value="<?= $value['qty'] ?>" name=qty[<?= $key ?>] onchange="setQty('<?= $key ?>')" min="1" pattern=" 0+\.[0-9]*[1-9][0-9]*$">
                            </td>
                            <td class="price">
                                <span><?= Yii::$app->func->formatPrice($total_money_by_product) ?></span>
                            </td>
                            <td class="action">
                                <a onclick="RemoveCart('<?= $key ?>')"><?= Yii::t('app','Delete item') ?></a>
                            </td>
                        </tr> 
                        <?php } } ?>                  
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" rowspan="2"></td>
                            <td colspan="3"><?= Yii::t('app','Total products (tax incl.)') ?></td>
                            <td colspan="2"><?= Yii::$app->func->formatPrice(0); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong><?= Yii::t('app','Total') ?></strong></td>
                            <td colspan="2"><strong><?= Yii::$app->func->formatPrice(Yii::$app->session['total_amount']?Yii::$app->session['total_amount']:0) ?></strong></td>
                        </tr>
                    </tfoot>    
                </table>
                <div class="cart_navigation">
                    <a class="prev-btn" onclick="goBack()"><?= Yii::t('app','Continue shopping') ?></a>
                    <?php if(Yii::$app->user->id) { ?>
                        <a class="next-btn" href="/checkout">
                    <?php } else {    ?>
                        <a class="next-btn login-for-checkout" href="/login">
                    <?php } ?>    
                    <?= Yii::t('app','Proceed to checkout') ?></a>
                </div>
            </div>
        </div>
    </div>
</div> 
<?=  yii\base\View::render('../elements/widget/popup_confirm_delete', ['title' => Yii::t('app','My Cart')]); ?>