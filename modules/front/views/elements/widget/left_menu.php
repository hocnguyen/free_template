<div class="col-xs-12 col-md-3 column-second-right">          
    <div class="collapse navbar-collapse"> 
                <div class="sidebar-widget">
                    <h4><?= Yii::t('app','Highest Download') ?></h4>             
                    <ul class="posts-list">
                        <?php 
                                $bestDownload  = Yii::$app->func->getBestSellingProducts();
                                foreach($bestDownload as $k=>$v) {
                            ?>
                             <li>                
                                <img src="/<?= $v->image ?>"  width="90" alt="">                  
                                <div class="content">
                                    <span class="time"><?= $v->created ?></span>
                                    <span class="pull-right"><i class="fa fa-download"></i> <span>524</span></span>                    
                                    <h2><a href="/detail/<?= $v->id ?>-<?= \Yii::$app->func->makeAlias($v->name); ?>" title="<?= $v->name ?>"><?= $v->name ?></a></h2>
                                </div>          
                            </li>
                        <?php } ?> 

                        
                                    
                    </ul>               
                </div>

            <div class="sidebar-widget">
                <h4><?= Yii::t('app','Tags') ?></h4>                                       
                    <div class="widget-tagcloud">
                        <?php 
                                $tags  = Yii::$app->func->getTags();
                                foreach($tags as $k=>$v) {
                            ?>
                             <a href="/tags/<?= $v['id'] ?>-<?= \Yii::$app->func->makeAlias($v['name']) ?>" class="tag-link level<?= ($v['total'] > Yii::$app->params['max_level_tag'])?Yii::$app->params['max_level_tag']:$v['total'] ?> "><?= $v['name'] ?><span>(<?= $v['total'] ?>)</span></a>
                        <?php } ?>          
                    </div>    
            </div>

    </div>             
</div>