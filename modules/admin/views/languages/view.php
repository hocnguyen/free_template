<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Languages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content languages-view">
  <div class="container-fluid">
    <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'flag',
            'languageculture',
            [
                'attribute' => 'is_display',
                'value'     => function($data) { return $data->display; },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'is_active',
                'value'     => function($data) { return $data->status; },
                'format'    => 'raw',
            ],
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
