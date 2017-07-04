<?php 
    error_reporting(0);
	$this->title = $data->page_title;
	$this->registerMetaTag(['name' => 'description', 'content' => $this->title.','.\Yii::$app->func->makeAlias($this->title).','.Yii::$app->params['site_name'] ]);
	$this->registerMetaTag(['name' => 'keyword', 'content' => $this->title.'-'.\Yii::$app->func->makeAlias($this->title).'-'.Yii::$app->params['site_name'] ]);
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <!-- row -->
        <div class="row">
        <?=  yii\base\View::render('../elements/widget/left_menu_blog', []); ?>
             <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2"><?= $data->page_title ?></span>
                </h1>
                <article class="entry-detail">
                    <div class="content-text clearfix">
                        <?= $data->page_text ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>