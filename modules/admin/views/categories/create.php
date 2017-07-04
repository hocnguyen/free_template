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

$this->title = Yii::t('app', 'Create Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
?>
<div class="page-content sub-page-content">
		<div class="container-fluid">
		   <?php echo yii\base\View::render('../elements/breadcrumbs',['breadcrumbs'=>$this->params['breadcrumbs'],'js'=>true]); ?>
			<div class="box-typical box-typical-padding categories-create">
			    <h1 class="custom-form-title"><?= Html::encode($this->title) ?></h1>
			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
			</div>
</div>
</div>