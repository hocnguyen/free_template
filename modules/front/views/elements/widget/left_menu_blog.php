 <div class="column col-xs-12 col-sm-3" id="left_column">
                <?php 
                    if (Yii::$app->user->id) {
                ?>
                    <div class="block left-module">
                        <p class="title_block"><?= Yii::t('app', 'Menu') ?></p>
                        <div class="block_content">
                             <div class="layered layered-category">
                                <div class="layered-content">
                                <ul class="tree-menu">
                                    <?php 
                                        $menu_customers  = Yii::$app->params['menu_customer'];
                                        foreach($menu_customers as $k=>$v) {
                                    ?>
                                     <li><span></span><a class="<?= (Yii::$app->controller->id == $k)?'active_tag':'' ?>" href="/<?= $k ?>"><?= $v ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Blog category -->
                <div class="block left-module">
                    <p class="title_block"><?= Yii::t('app','Blog Categories') ?></p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    <?php 
                                        $category = Yii::$app->func->getAllCategories();
                                        foreach ($category as $key=>$val) {
                                    ?>
                                    <li <?= (isset($cate->id) && $cate->id == $val->id)?"class='active'":'' ?> ><span></span><a href="/cate/<?= $val->id ?>-<?= Yii::$app->func->makeAlias($val->name) ?>"><?= $val->name ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./blog category  -->
                <!-- tags -->
                <div class="block left-module">
                    <p class="title_block"><?= Yii::t('app','TAGS') ?></p>
                    <div class="block_content">
                        <div class="tags">

                            <?php 
                                $tags  = Yii::$app->func->getTagPost();
                                foreach($tags as $k=>$v) {
                            ?>
                            <a href="/news/tags/<?= $v['id'] ?>-<?= \Yii::$app->func->makeAlias($v['name']) ?>"><span class="level<?= ($v['total'] > Yii::$app->params['max_level_tag'])?Yii::$app->params['max_level_tag']:$v['total'] ?>  <?= (isset($tag) && $tag->id == $v['id'])?'active_tag':'' ?>"><?= $v['name'] ?></span></a>
                            <?php } ?>            
                        </div>
                    </div>
                </div>
                <!-- ./tags -->
                
                <!-- Popular Posts -->
                <div class="block left-module">
                    <p class="title_block"><?= Yii::t('app','Popular Posts') ?></p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered">
                            <div class="layered-content">
                                <ul class="blog-list-sidebar clearfix">
                                    <?php 
                                        $popular_post = Yii::$app->func->getPopularPost();
                                        foreach ($popular_post as $key=>$val) {
                                    ?>
                                    <li>
                                        <div class="post-thumb">
                                            <a href="/news/detail/<?= $val->id ?>-<?= Yii::$app->func->makeAlias($val->title) ?>"><img src="/<?= $val->image ?>" alt="<?= $val->title ?>"></a>
                                        </div>
                                        <div class="post-info">
                                            <h5 class="entry_title"><a href="/news/detail/<?= $val->id ?>-<?= Yii::$app->func->makeAlias($val->title) ?>"><?= $val->title ?></a></h5>
                                            <div class="post-meta">
                                                <span class="date"><i class="fa fa-calendar"></i> <?= $val->created ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./Popular Posts -->
            
                
              
            </div>