<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha; 
    $this->title = 'Register System';
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Register']); ?>   
        <h2 class="page-heading">
            <span class="page-heading-title2"><?= Yii::t('app','Register') ?></span>
        </h2>
        <div class="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-authentication">
                        <?php if (Yii::$app->session->hasFlash('error_regsiter')): ?>
                            <div class="msg-danger msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('error_regsiter') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php if (Yii::$app->session->hasFlash('success_regsiter')): ?>
                            <div class="msg-success msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('success_regsiter') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

                            <?= $form->field($modelSignup, 'username')->textInput() ?>

                            <?= $form->field($modelSignup, 'email') ?>

                            <?= $form->field($modelSignup, 'password')->passwordInput() ?>

                            <?= $form->field($modelSignup, 'fname') ?>

                            <?= $form->field($modelSignup, 'lname') ?>

                            <div class="captcha_register"> </div>    

                            <?= $form->field($modelSignup, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                'captchaAction' => 'users/captcha',
                            ]) ?>

                            <div class="form-group">
                                <button class="button btn btn-primary" type="submit"><i class="fa fa-user"></i> <?= Yii::t('app','Create an account') ?></button>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>