<li class="list-view">                          
    <div class="iso-thumbnail">
        <img src="/<?= $model->image ?>"  width="200" height="90" alt="<?= $model->name ?>"> 
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
    
    <div class="iso-demo">
        <span>$48</span>
        <span class="license">(regular license)</span>
                                        
        <div class="btn-group stats" role="group" aria-label="...">
          <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" data-container="body" title="demo"><i class="fa fa-eye"></i></button>
          <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" data-container="body" title="bookmark"><i class="fa fa-bookmark"></i></button>
          <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" data-container="body" title="buy now"><i class="fa fa-cart-arrow-down"></i></button>
        </div>  
    </div> 
    <div class="clear"></div>                           
</li>