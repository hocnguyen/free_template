<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    $this->title = 'Verify your account';
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Authentication']); ?>   
        <h2 class="page-heading">
            <span class="page-heading-title2"><?= Yii::t('app','Authentication') ?></span>
        </h2>
        <div class="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-authentication">
                      <?php if (Yii::$app->session->hasFlash('error_active_account')): ?>
                            <div class="msg-danger msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('error_login') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>

                     <?php if (Yii::$app->session->hasFlash('success_active_account')): ?>
                            <div class="msg-success msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('success_active_account') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>

                      <?php echo \yii\helpers\Html::beginForm(Yii::$app->getUrlManager()->createUrl('users/login'), 'post'); ?>
                        <h3><?= Yii::t('app','Already registered?') ?></h3>
                        <label for="emmail_login"><?= Yii::t('app','Username or Email address') ?></label>
                        <input name="LoginForm[username]" type="text" class="form-control" required="">
                        <label for="password_login"><?= Yii::t('app','Password') ?></label>
                        <input name="LoginForm[password]" type="password" class="form-control" required="">
                        <p class="forgot-pass"><a href="#"><?= Yii::t('app','Forgot your password?') ?></a></p>
                        <button class="button btn btn-primary" type="submit"><i class="fa fa-lock"></i><?= Yii::t('app','Sign in') ?></button>
                        <?php echo \yii\helpers\Html::endForm(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>