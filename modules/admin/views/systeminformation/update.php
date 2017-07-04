<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SystemInformation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'System Information',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Informations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="page-content sub-page-content system-information-update">
	<div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
    	<div class="box-typical box-typical-padding categories-create">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
    	</div>
 	</div>
</div>
