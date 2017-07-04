<?php 
	$this->title = Yii::t('app','Blog');
	$this->registerMetaTag(['name' => 'description', 'content' => $this->title.','.\Yii::$app->func->makeAlias($this->title).','.Yii::$app->params['site_name'] ]);
	$this->registerMetaTag(['name' => 'keyword', 'content' => $this->title.'-'.\Yii::$app->func->makeAlias($this->title).'-'.Yii::$app->params['site_name'] ]);
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <!-- row -->
        <div class="row">
        <?=  yii\base\View::render('../elements/widget/left_menu_blog', []); ?>
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h2 class="page-heading">
                    <span class="page-heading-title2"><?= Yii::t('app','Blog post') ?></span>
                </h2>
                <ul class="blog-posts">
                    <?php \yii\widgets\Pjax::begin(); ?>
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$posts,
                                'itemView' => 'posts_view',
                                'summary'  =>'',
                        ] );?>
                        <?php \yii\widgets\Pjax::end(); ?> 
                </ul>
            </div>
        </div>
    </div>
</div>