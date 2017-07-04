<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Checkout']); ?>  
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2"><?= Yii::t('app','Review your Order') ?></span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content checkout-page">   
            <h3 class="checkout-sep"><?= Yii::t('app','Payment Information') ?></h3>
            <div class="box-border">
                <ul>
                    <li>
                        <label for="radio_button_5"><input type="radio" checked name="radio_4" id="radio_button_5"> <?= Yii::t('app','Paypal') ?></label> <img src="/uploads/payment-method/2181-paypal-512.png" style="width:68px;" alt="Paypal">
                    </li>
                </ul>
            </div>
            <h3 class="checkout-sep"><?= Yii::t('app','Review and confirm your order') ?> (<?= count(Yii::$app->session['cart']) ?> <?= Yii::t('app','items') ?>): </h3>
            <div class="box-border">
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
                                <input class="form-control input-sm" type="text" value="<?= $value['qty'] ?>" readonly>
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
                <a href="/payment"><button class="button pull-right"><?= Yii::t('app','Confirm & Pay') ?></button> </a>
            </div>
        </div>
    </div>
</div>
<?=  yii\base\View::render('../elements/widget/popup_confirm_delete', ['title' => Yii::t('app','My Cart')]); ?>