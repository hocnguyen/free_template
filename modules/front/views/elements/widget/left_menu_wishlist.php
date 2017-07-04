<div class="column col-xs-12 col-sm-3" id="left_column">
                <div class="block left-module">
                    <p class="title_block"><?= Yii::t('app', 'Menu') ?></p>
                    <div class="block_content">
                         <div class="layered layered-category">
                            <div class="layered-content">
                            <ul class="tree-menu">
                                <?php 
                                    if (Yii::$app->user->id) {
                                    $menu_customers  = Yii::$app->params['menu_customer'];
                                    foreach($menu_customers as $k=>$v) {
                                ?>
                                 <li><span></span><a class="<?= (Yii::$app->controller->id == $k)?'active_tag':'' ?>" href="/<?= $k ?>"><?= Yii::t('app',$v) ?></a></li>
                                <?php } } else { ?>
                                    <li><span></span><a class="active_tag" href="/infor"><?= Yii::t('app','My Information' ) ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>

               <div class="block left-module">
                    <p class="title_block"><?= Yii::t('app','Categories') ?></p>
                    <div class="block_content">
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    <?php 
                                        $menu_categoriews = \Yii::$app->func->getMenuCateogry();
                                        foreach ($menu_categoriews as $i=>$c){
                                    ?>    
                                    <li><span></span><a href="/category/<?= $c->id ?>-<?= \Yii::$app->func->makeAlias($c->name) ?>"><?= $c->name ?> (<?= intval(\Yii::$app->func->totalProductsByCategory($c->id)) ?>)</a>
                                            <?php 
                                            $sm = \Yii::$app->func->getMenuSubCategory($c->id);
                                            if (isset($sm)) {  ?>
                                                <ul >
                                                    <?php foreach ($sm as $s){ ?>
                                                        <li><span></span><a href="/category/<?= $s->id ?>-<?= \Yii::$app->func->makeAlias($s->name) ?>"><?= $s->name ?> (<?= intval(\Yii::$app->func->totalProductsByCategory($s->id)) ?>)</a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>