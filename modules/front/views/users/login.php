<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha; 
    $this->title = 'Login System';
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
                      <?php if (Yii::$app->session->hasFlash('error_wishlist')): ?>
                            <div class="msg-success msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('error_wishlist') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>

                      <?php if (Yii::$app->session->hasFlash('error_login')): ?>
                            <div class="msg-danger msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('error_login') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>

                     <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput() ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                       <p class="forgot-pass">
                            <a href="/register" class="join-free-now"><?= Yii::t('app','Join free now!') ?></a>
                            <a href="/forgot-password" class="forgot-pass"><?= Yii::t('app','Forgot your password?') ?></a>
                       </p>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'button btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>