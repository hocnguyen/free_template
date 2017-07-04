<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slidershow */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Slidershow',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slidershows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="page-content sub-page-content slidershow-update">
	<div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
    	<div class="box-typical box-typical-padding categories-create">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
    	</div>
 	</div>
</div>
