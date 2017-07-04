<div class="row banner-bottom">
    <?php 
        $banners = Yii::$app->func->getBanners();
        foreach ($banners as $val){
    ?>
    <div class="col-sm-6">
        <div class="banner-boder-zoom">
            <a href="<?= $val->link ?>"><img alt="<?= $val->name ?>" class="img-responsive" src="<?= Yii::getAlias('@uploads') ?>/banners/<?= $val->filename ?>" /></a>
        </div>
    </div>
    <?php } ?>
</div>