<?php
error_reporting(0);
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\ProductReviews */

$this->title = Yii::t('app', 'Product Reviews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Reviews'), 'url' => ['index']];
?>
<div class="columns-container">
    <div class="container" id="columns">
    <?=  yii\base\View::render('../elements/breadcrumb',['subTitle'=>$this->title]); ?> 
        <div class="row">

            <?=  yii\base\View::render('../elements/widget/left_menu', []); ?>

        <div class="center_column col-xs-12 col-sm-9" id="center_column">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'productName',
                'format'    => 'html',
                'value'     => function($data) { return $data->productNameFE; },
            ],
            [
                'attribute' => 'rate',
                'value'     =>  StarRating::widget([
                                    'name' => 'rate',
                                    'value' => $model->rate,
                                    'disabled' => true
                                ]),
                'format'    => 'raw',
            ],
            'comment:html',
            'created',
            'updated',
        ],
    ]) ?>
            </div>
        </div>
    </div>
</div>
