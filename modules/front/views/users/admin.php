 <?php if( Yii::$app->session->hasFlash('errorLogin') ): ?>
    <div class="alert alert-dismissable alert-danger">
        <strong><?php echo Yii::t('app','Error!'); ?></strong> <?php echo Yii::t('app', 'Sorry, But we can\'t find a member with those login information.');  ?>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    </div>
<?php endif; ?>

 <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
               <?php echo \yii\helpers\Html::beginForm(Yii::$app->getUrlManager()->createUrl('users/admin'), 'post', array('class'=>'sign-box')); ?>
                    <div class="sign-avatar">
                        <img src="<?= Yii::getAlias('@back') ?>/img/avatar-sign.png" alt="">
                    </div>
                    <header class="sign-title">Sign In</header>
                    <div class="form-group">
                        <input name="LoginForm[username]" type="text" class="form-control" required="" placeholder="E-Mail or Phone"/>
                    </div>
                    <div class="form-group">
                        <input name="LoginForm[password]" type="password" class="form-control" required="" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <div class="checkbox float-left">
                            <input type="checkbox" id="signed-in"/>
                            <label for="signed-in">Keep me signed in</label>
                        </div>
                        <div class="float-right reset">
                            <a href="reset-password.html">Reset Password</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rounded">Sign in</button>
               <?php echo \yii\helpers\Html::endForm(); ?>
            </div>
        </div>
    </div>