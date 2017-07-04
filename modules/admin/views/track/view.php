<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Track */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tracks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content track-view">
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
            'ip',
            [
                'label'  => Yii::t('app','Customer'),
                'attribute' => 'customerName',
                'format' => 'html',
                'value'  => function($data) { return $data->memberName; },
            ],
            'country_code',
            'country_name',
            'region_code',
            'region_name',
            'city',
            'zip_code',
            [
                'attribute' => 'time_zone',
                'format' => 'raw',
                'value'  => function($data) { return $data->wikiTimeZone; },
            ],
            [
                'attribute' => 'latitude',
                'format' => 'raw',
                'value'  => function($data) { return $data->mapLatitude; },
            ],
            [
                'attribute' => 'longitude',
                'format' => 'raw',
                'value'  => function($data) { return $data->maplongitude; },
            ],
            'metro_code',
            'agent',
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
