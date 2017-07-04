<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tags */

$this->title = Yii::t('app', 'Create Tags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
?>
<div class="page-content sub-page-content tags-create">
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
