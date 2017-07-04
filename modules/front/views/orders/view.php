<?php
error_reporting(0);
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = Yii::t('app','My orders - detail');
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
                            'value'     => function($data) { return $data->productNameFE; },
                            'format'    => 'raw',
                        ],
                        [
                            'attribute' => 'quantity',
                            'value'     => function($data) { return $data->quantity; },
                            'format'    => 'raw',
                        ],
                        [
                            'attribute' => 'unitPrice',
                            'value'     => function($data) { return $data->unitPrice; },
                            'format'    => 'raw',
                        ],
                        [
                            'attribute' => 'amount',
                            'value'     => function($data) { return $data->totalAmount; },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'status_id',
                            'format'    => 'raw',
                            'value'     => function($data) { return $data->nameStatus; },
                        ],
                        'created',
                        'updated',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
