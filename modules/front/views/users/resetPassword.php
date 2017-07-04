<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
?>
<div class="columns-container">
    <div class="container" id="columns">
        <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>'Reset password']); ?>   
        <h2 class="page-heading">
            <p><?= Yii::t('app','Please choose your new password:') ?></p>
        </h2>
        <div class="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-authentication">
                      <?php if (Yii::$app->session->hasFlash('success_reset_password')): ?>
                            <div class="msg-success msg">
                                <p>
                                    <?php echo Yii::$app->session->getFlash('success_reset_password') ?>
                                    <a class="close close-alert"><?php echo  Yii::t('app','close'); ?></a>
                                </p>
                            </div>
                     <?php endif; ?>
                     <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>