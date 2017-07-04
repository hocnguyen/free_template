<div id="content-wrap">
    <div class="container">
        <div id="hot-categories" class="row">
            <div class="col-sm-12 group-title-box">
                <h2 class="group-title ">
                    <span><?= Yii::t('app','Categories') ?></span>
                </h2>
            </div>
            <?php
                foreach ($categories->getModels() as $key=>$val ){
            ?>
            <div class="col-sm-6  col-lg-3 cate-box">
                <div class="cate-tit" >
                    <div class="div-1" style="width: 46%;">
                        <div class="cate-name-wrap">
                            <p class="cate-name"><?= $val->name ?></p>
                        </div>
                        <a href="/category/<?= $val->id ?>-<?= \Yii::$app->func->makeAlias($val->name) ?>" class="cate-link link-active" data-ac="flipInX" ><span><?= Yii::t('app','View') ?></span></a>
                    </div>
                    <div class="div-2" >
                        <a href="/category/<?= $val->id ?>-<?= \Yii::$app->func->makeAlias($val->name) ?>">
                            <img src="<?= Yii::getAlias('@uploads') ?>/categories/<?= $val->image_hot ?>" alt="<?= $val->name ?>" class="hot-cate-img" />
                        </a>
                    </div>
                    
                </div>
                <div class="cate-content">
                    <ul>
                        <?php 
                            $subCategory = Yii::$app->func->getSubCategory($val->id);
                            foreach ($subCategory as $k=>$value) {
                        ?> 
                        <li><a href="/category/<?= $value->id ?>-<?= \Yii::$app->func->makeAlias($value->name) ?>"><?= $value->name ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>  
            <?php } ?>
        </div> 
        
    </div>
</div>