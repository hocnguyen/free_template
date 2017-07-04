<li class="post-item">
                        <article class="entry">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="entry-thumb image-hover2">
                                        <a href="/news/detail/<?= $model['id'] ?>-<?= Yii::$app->func->makeAlias($model['title']) ?>">
                                            <img src="/<?= $model['image'] ?>" alt="<?= $model['title'] ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="entry-ci">
                                        <h3 class="entry-title"><a href="/news/detail/<?= $model['id'] ?>-<?= Yii::$app->func->makeAlias($model['title']) ?>"><?= $model['title'] ?></a></h3>
                                        <div class="entry-meta-data">
                                            <span class="author">
                                            <i class="fa fa-user"></i> 
                                            <?= Yii::t('app','by') ?>: <a href=""><?php $user_post = Yii::$app->func->getUser($model['user_id']);  echo ucfirst($user_post->username); ?></a></span>
                                            <span class="cat">
                                                <i class="fa fa-folder-o"></i>
                                                <?= Yii::$app->func->getCategories($model['id']);?>
                                            </span>
                                            <span class="date"><i class="fa fa-calendar"></i> <?= $model['created'] ?></span>
                                        </div>
                                        <div class="post-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <span>(7 votes)</span>
                                        </div>
                                        <div class="entry-excerpt">
                                            <?= $model['description'] ?>
                                        </div>
                                        <div class="entry-more">
                                            <a href="/news/detail/<?= $model['id'] ?>-<?= Yii::$app->func->makeAlias($model['title']) ?>"><?= Yii::t('app','Read more') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>