<?php 
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
	error_reporting(0);
	use yii\helpers\Html;
	if($js)
		$this->registerJsFile('backend/js/lib/bootstrap/bootstrap.min.js', ['depends' => [yii\web\JqueryAsset::className()]]); 
?>
<header class="section-header">
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<ol class="breadcrumb breadcrumb-simple">
					<li><a href="<?= Yii::$app->params['url_admin'] ?>" title="<?= Yii::t('app', 'Home') ?>"><?= Yii::t('app', 'Home') ?></a></li>
					<?php
		                if( isset($this->params['breadcrumbs']) ){
		                    $links = array();
		                    $links[] = Html::a(Yii::t('app', 'Home'), Yii::$app->params['url_admin']);
		                    if(count($this->params['breadcrumbs']))
		                    {
		                        foreach($this->params['breadcrumbs'] as $url)
		                        {
		                            echo '<li>' .  Html::a(Yii::t('app',$url['label']), $url['url']). '</li>';
		                        }
		                    }
		                }
                	?>
				</ol>
			</div>
		</div>
	</div>
</header>