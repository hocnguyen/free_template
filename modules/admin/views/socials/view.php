<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Socials */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Socials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$this->title];
?>
<div class="page-content sub-page-content socials-view">
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
            'type',
            [
                'attribute' => 'icon',
                'format'    => 'raw',
                'value'     => function($data) { return $data->icons; },
            ],
            'social_link:url',
            [
                'attribute' => 'is_display',
                'value'     =>  ($model->is_display==1)?"Enable":"Disable",
                'format'    => 'raw',
            ],
            'created',
            'updated',
        ],
    ]) ?>
  </div>
</div>
