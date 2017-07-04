<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethods */

$this->title = Yii::t('app', 'Create Payment Methods');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Methods'), 'url' => ['index']];
?>
<div class="page-content sub-page-content payment-methods-create">
	<div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
     <div class="box-typical box-typical-padding categories-create">
        <h1 class="custom-form-title"><?=  Html::encode($this->title) ?></h1>
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
     </div>
    </div>
</div>
