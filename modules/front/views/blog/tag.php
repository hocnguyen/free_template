<?php 
	$this->title = $tag->name;
	$this->registerMetaTag(['name' => 'description', 'content' => $this->title.','.\Yii::$app->func->makeAlias($this->title).','.Yii::$app->params['site_name'] ]);
	$this->registerMetaTag(['name' => 'keyword', 'content' => $this->title.'-'.\Yii::$app->func->makeAlias($this->title).'-'.Yii::$app->params['site_name'] ]);
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <div class="row">
        <?=  yii\base\View::render('../elements/widget/left_menu_blog', ['tag'=>$tag]); ?>
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h2 class="page-heading">
                    <span class="page-heading-title2"><?= $this->title ?></span>
                </h2>
                <ul class="blog-posts">
                    <?php \yii\widgets\Pjax::begin(); ?>
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$posts,
                                'itemView' => 'tag_view',
                                'summary'  =>'',
                        ] );?>
                        <?php \yii\widgets\Pjax::end(); ?> 
                </ul>
            </div>
        </div>
    </div>
</div>