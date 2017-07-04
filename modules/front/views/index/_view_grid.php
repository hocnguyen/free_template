<li class="grid-view-big">                          
    <div class="iso-thumbnail">
        <img src="/<?= $model->image ?>" width="200" height="102" alt="<?= $model->name ?>">
        
    <div class="ribbon-featured">
        <div class="class panel-tooltip" data-toggle="tooltip" data-placement="right" data-original-title="featured"><i class="fa fa-star"></i></div>
    </div>
    
    </div>
    
    <div class="iso-desc">
        <h4><a href="/detail/<?= $model->id ?>-<?= \Yii::$app->func->makeAlias($model->name); ?>"><?= $model->name  ?></a></h4>
        <img src="<?= Yii::getAlias('@front') ?>/images/starrating2b.png" class="rating" width="80" height="16" alt="">
        <img src="<?= Yii::getAlias('@front') ?>/images/img_avatar.jpg" width="20" class="thumb img-responsive img-circle pull-left" alt="">
        <a href="#" class="author">pixelgrade</a>
        <span class="categories">In <a href="#">Wordpress</a> <i class="fa fa-angle-double-right"></i> <a href="#">Creative</a> <i class="fa fa-angle-double-right"></i> <a href="#">Portfolio</a></span>
    </div>
    
    <div class="clear"></div>                           
</li> 