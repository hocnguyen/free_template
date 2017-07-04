<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Categories',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="page-content sub-page-content">
		<div class="container-fluid">
		<?php echo yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>	
    <div class="box-typical box-typical-padding categories-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
</div>
