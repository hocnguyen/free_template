<?php 
    $this->title = $data->title;
    $this->registerMetaTag(['name' => 'description', 'content' => $data->title.','.\Yii::$app->func->makeAlias($data->title).','.Yii::$app->params['site_name'] ]);
    $this->registerMetaTag(['name' => 'keyword', 'content' => $data->title.'-'.\Yii::$app->func->makeAlias($data->title).'-'.Yii::$app->params['site_name'] ]);
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <!-- row -->
        <div class="row">
           <?=  yii\base\View::render('../elements/widget/left_menu_blog', []); ?>
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2"><?= $data->title ?></span>
                </h1>
                <article class="entry-detail">
                    <div class="entry-meta-data">
                        <span class="author">
                        <i class="fa fa-user"></i> 
                        by: <a href="#"><?php $user_post = Yii::$app->func->getUser($data->user_id);  echo ucfirst($user_post->username); ?></a></span>
                        <span class="cat">
                            <i class="fa fa-folder-o"></i>
                            <?= Yii::$app->func->getCategories($data->id);?>
                        </span>
                        <span class="date"><i class="fa fa-calendar"></i> <?= $data->created ?></span>
                    </div>
                    <div class="entry-photo">
                        <img src="/<?= $data->image ?>" alt="Blog">
                    </div>
                    <div class="content-text clearfix">
                        <?= $data->description ?>
                        <?= $data->content ?>
                    </div>
                    <div class="entry-tags">
                        <span><?= Yii::t('app','Tags') ?>:</span>
                        <?= Yii::$app->func->getTagsByPost($data->id); ?>
                    </div>
                </article>
                <!-- Related Posts -->
                <?php if(count($relate_post) > 0) { ?>
                <div class="single-box">
                    <h2><?= Yii::t('app','Related Posts') ?></h2>
                    <ul class="related-posts owl-carousel" data-dots="false" data-loop="false" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                        <?php
                            foreach ($relate_post as $kr => $vr) {
                        ?>
                        <li class="post-item">
                            <article class="entry">
                                <div class="entry-thumb image-hover2">
                                    <a href="/news/detail/<?= $vr->id ?>-<?= Yii::$app->func->makeAlias($vr->title) ?>">
                                        <img src="/<?= $vr->image ?>" alt="<?= $vr->title ?>">
                                    </a>
                                </div>
                                <div class="entry-ci">
                                    <h3 class="entry-title"><a href="/news/detail/<?= $vr->id ?>-<?= Yii::$app->func->makeAlias($vr->title) ?>"><?= $vr->title ?></a></h3>
                                    <div class="entry-meta-data">
                                        <span class="date">
                                            <i class="fa fa-calendar"></i> <?= $vr->created ?>
                                        </span>
                                    </div>
                                    <div class="entry-more">
                                        <a href="/news/detail/<?= $vr->id ?>-<?= Yii::$app->func->makeAlias($vr->title) ?>"><?= Yii::t('app','Read more') ?></a>
                                    </div>
                                </div>
                            </article>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <!-- ./Related Posts -->
                <!-- Comment -->
              <!--   <div class="single-box">
                    <h2 class="">Comments</h2>
                    <div class="comment-list">
                        <ul>
                            <li>
                                <div class="avartar">
                                    <img src="assets/data/avatar.png" alt="Avatar">
                                </div>
                                <div class="comment-body">
                                    <div class="comment-meta">
                                        <span class="author"><a href="#">Admin</a></span>
                                        <span class="date">2015-04-01</span>
                                    </div>
                                    <div class="comment">
                                        Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                                    </div>
                                </div>
                            </li>
                            <li>
                                <ul>
                                    <li>
                                        <div class="avartar">
                                            <img src="assets/data/avatar.png" alt="Avatar">
                                        </div>
                                        <div class="comment-body">
                                            <div class="comment-meta">
                                                <span class="author"><a href="#">Admin</a></span>
                                                <span class="date">2015-04-01</span>
                                            </div>
                                            <div class="comment">
                                                Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="avartar">
                                            <img src="assets/data/avatar.png" alt="Avatar">
                                        </div>
                                        <div class="comment-body">
                                            <div class="comment-meta">
                                                <span class="author"><a href="#">Admin</a></span>
                                                <span class="date">2015-04-01</span>
                                            </div>
                                            <div class="comment">
                                                Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="avartar">
                                    <img src="assets/data/avatar.png" alt="Avatar">
                                </div>
                                <div class="comment-body">
                                    <div class="comment-meta">
                                        <span class="author"><a href="#">Admin</a></span>
                                        <span class="date">2015-04-01</span>
                                    </div>
                                    <div class="comment">
                                        Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="avartar">
                                    <img src="assets/data/avatar.png" alt="Avatar">
                                </div>
                                <div class="comment-body">
                                    <div class="comment-meta">
                                        <span class="author"><a href="#">Admin</a></span>
                                        <span class="date">2015-04-01</span>
                                    </div>
                                    <div class="comment">
                                        Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="single-box">
                    <h2>Leave a Comment</h2>
                    <div class="coment-form">
                        <p>Make sure you enter the () required information where indicated. HTML code is not allowed.</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <label for="website">Website URL</label>
                                <input id="website" type="text" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <label for="message">Message</label>
                                <textarea name="message" id="message"rows="8" class="form-control"></textarea>
                            </div>
                        </div>
                        <button class="btn-comment">Submit</button>
                    </div>
                </div> -->
                <!-- ./Comment -->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>