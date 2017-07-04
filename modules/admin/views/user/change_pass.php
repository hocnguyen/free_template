<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Change Passwor User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
?>
<div class="page-content sub-page-content user-create">
	<div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
     <div class="box-typical box-typical-padding categories-create">
     	 <?php if( Yii::$app->session->hasFlash('success_change_pass') ): ?>
		    <div class="alert alert-dismissable alert-success">
		        <?php echo Yii::$app->session->getFlash('success_change_pass') ?>
		        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		    </div>
		<?php endif; ?>

        <h1 class="custom-form-title"><?=  Html::encode($this->title) ?></h1>
	   	  <p>Please choose your new password:</p>
			<div class="user-form">
			    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            	<?php ActiveForm::end(); ?>

			</div>

     </div>
    </div>
</div>