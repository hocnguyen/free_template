<?php 
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha;
        $this->title = 'Contact Us';
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Contact']); ?>  
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2"><?= Yii::t('app','Contact Us') ?></span>
        </h2>
        <!-- ../page heading-->
        <div id="contact" class="page-content page-contact">
            <div id="message-box-conact"></div>
            <?php if (Yii::$app->session->hasFlash('errorMailContact')): ?>
                <div class="msg-danger msg">
                    <p>
                        <?php echo Yii::$app->session->getFlash('errorMailContact') ?>
                        <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('successContact')): ?>
                <div class="msg-success msg">
                    <p>
                        <?php echo Yii::$app->session->getFlash('successContact') ?>
                        <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                    </p>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="page-subheading"><?= Yii::t('app','CONTACT FORM') ?></h3>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput() ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            'captchaAction' => 'index/captcha',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
                </div>
                <div class="col-xs-12 col-sm-6" id="contact_form_map">
                    <h3 class="page-subheading"><?= Yii::t('app','Information') ?></h3>
                    <p><?= Yii::t('app',"I'm Vinh Tran. I'm passionate about technology, music, coffee, traveling and everything visually stimulating. Constantly learning and experiencing new things.") ?></p>
                    <br/>
                    <ul class="store_info">
                        <li><i class="fa fa-home"></i>K47/19 Le Ba Trinh, Hai Chau, Da Nang city</li>
                        <li><i class="fa fa-phone"></i><span>0905246855-0905557507</span></li>
                        <li><i class="fa fa-envelope"></i><?= Yii::t('app','Email') ?>: <span><a href="mailto:admin@clickbuyall.com">admin@clickbuyall.com</a></span></li>
                    </ul>                
                    </div>
            </div>
        </div>
    </div>
</div>