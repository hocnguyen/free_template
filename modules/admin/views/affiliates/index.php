<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Affiliates');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $this->title), 'url' => ['index']];
?>
<div class="page-content sub-page-content">
    <div class="container-fluid categories-index">
     <?=  yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs']]); ?>    
        <section class="box-typical box-typical-max-280 scrollable">
                <header class="box-typical-header">
                    <div class="tbl-row">
                        <div class="tbl-cell tbl-cell-title">
                            <h3><?= Yii::t('app','Coming soon') ?></h3>
                        </div>
                    </div>
                </header>
                <div class="box-typical-body jspScrollable" style="overflow: hidden; padding: 0px; width: 1047px;" tabindex="0">
                    
                <div class="jspContainer" style="width: 1047px; height: 280px;"><div class="jspPane" style="padding: 0px; top: 0px; width: 1035px;"><div class="table-responsive">
                        <table class="table table-hover">
                           
                        </table>
                    </div></div></div></div>
            </section>


    </div>
</div>

