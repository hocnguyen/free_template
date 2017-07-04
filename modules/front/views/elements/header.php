<div class="topbar version-two">
<div class="container">
   <nav class="navbar">
    <div class="res-mobile section-menu-common">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="/"><img src="<?= Yii::getAlias('@front') ?>/images/logo-mobile.png" class="main-logo" alt=""></a>
      </div>
    <div id="navbar1" class="navbar-collapse collapse row menu-header section-menu-common">
        <div class="col-md-9 align-left menu-main-one section-menu-common">          
            <ul class="sub-menu nav navbar-nav">
                <li><a href="/"><?= Yii::t('app','Home')  ?></a></li>
                 <?php
                                $menus = \Yii::$app->func->getMenuCateogry();
                                if ($menus){
                                    foreach ($menus as $key=>$val){
                           ?>
                            <li class="dropdown">
                                <?php 
                                    $submenu = \Yii::$app->func->getMenuSubCategory($val->id);
                                    if ($submenu) {
                                ?> 
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $val->name ?><b class="caret"></b> </a>
                                 <?php } else { ?>
                                <a href="/category/<?= $val->id ?>-<?= \Yii::$app->func->makeAlias($val->name) ?>" > <?= $val->name ?> </a>                          
                                <?php } if ($submenu) { ?>
                                    <ul class="dropdown-menu">
                                       <?php  foreach ($submenu as $key=>$val){  ?>
                                            <li><a href="/category/<?= $val->id ?>-<?= \Yii::$app->func->makeAlias($val->name) ?>"><?= $val->name ?></a></li>
                                        <?php } ?>
                                     </ul>
                                <?php } ?>
                            </li>  
                            <?php } } ?> 

            </ul>
        </div>

        <div class="col-md-3 align-right menu-main-two section-menu-common">          
          <ul class="sub-menu nav navbar-right navbar-nav">
            <li class="dropdown language">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <?php 
                            $language = \Yii::$app->func->getLanguagesActive(\Yii::$app->language);
                      ?>
                      <img src="<?= Yii::getAlias('@front') ?>/images/languages/<?= $language->languageculture ?>.png" /><?=Yii::t('app',$language->name) ?> 
              <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                      $languages = \Yii::$app->func->getLanguagesAll();
                      if( $languages ){
                           foreach ($languages as $val){
                    ?>
                      <li><a class="lang <?= (\Yii::$app->language == $val->languageculture)?'active_lang':'' ?>" href="?lang=<?= $val->languageculture ?>"><img src="<?= Yii::getAlias('@front') ?>/images/languages/<?= $val->languageculture ?>.png" /><?= Yii::t('app',$val->name) ?></a></li>
                      <?php } } ?>
                </ul>
              
            </li>
            <?php if(\Yii::$app->user->id) { ?> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= Yii::t('app','Admin')  ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <?php 
                    $menu_customers  = Yii::$app->params['menu_customer'];
                    foreach($menu_customers as $k=>$v) {
                    ?>
                  <li><a class="<?= (Yii::$app->controller->id == $k)?'active_lang':'' ?>" href="/<?= $k ?>"><?= $v ?></a></li>
                <?php } ?>
              </ul>
            </li>
            <?php } else { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= Yii::t('app','My Account')  ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="/login"><?= Yii::t('app','Login') ?></a></li> 
                  <li><a href="/register"><?= Yii::t('app','Register') ?></a></li>
              </ul> 
            <?php } ?> 
          </ul>

        </div>     
    </div>
    </nav>
</div>
</div>

<div class="topbar menu-mar">
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-3 block-logo">
            <a href="/"><img src="<?= Yii::getAlias('@front') ?>/images/logo.png" class="main-logo" alt=""></a>
        </div>
      <div class="col-xs-12 col-md-6 info-stats">
        <!-- <span>4,082,857</span> community members | <span>5,741,150</span> items for sale -->
      </div>
      <div class="col-xs-12 col-md-3 search">
      
      <form class="search-form" role="search" action="#" method="get">
                    <div class="form-group">
                      <input type="text" id="search-form" class="form-control" placeholder="Search...">
                      <button type="submit" class="btn btn-default btn-search"></button>
                      </div>                
      </form>
      
      </div>
    </div>
</div>
</div>