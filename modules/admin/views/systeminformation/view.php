<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SystemInformation */

$this->title = $model->version;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Informations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content system-information-view">
  <div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'author',
            'version',
            'technical:html',
            'modules:html',
            'next_upgrade:html'
        ],
    ]) ?>
  </div>
</div>
