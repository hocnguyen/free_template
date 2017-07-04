<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Request password reset']); ?>   
        <h2 class="page-heading">
            <p><?= Yii::t('app','Please fill out your email. A link to reset password will be sent there.') ?></p>
        </h2>
        <div class="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-authentication">
                      <?php if (Yii::$app->session->hasFlash('error_request_password')): ?>
                            <div class="msg-danger msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('error_request_password') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>
                     <?php if (Yii::$app->session->hasFlash('success_request_password')): ?>
                            <div class="msg-success msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('success_request_password') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>
                     <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                            <?= $form->field($model, 'email')->textInput() ?>
                            <div class="form-group">
                                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
