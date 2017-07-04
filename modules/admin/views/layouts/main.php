<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/14/17
 * Time: 11:46 PM
 */
use yii\helpers\Html;
use app\modules\admin\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="author" content="VinhTQ-Designwebvn">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo isset($this->title)?Html::encode($this->title).'-'.Yii::t('app', 'Admin'):Yii::t('app', 'Admin') ?></title>
    <?php $this->head() ?>
</head>
<body class="with-side-menu control-panel control-panel-compact">
<?php $this->beginBody() ?>
    <?php echo yii\base\View::render('../elements/header'); ?>
    <?php echo yii\base\View::render('../elements/side_menu'); ?>
    <?php echo $content; ?>
    
    <script>
        $(document).ready(function() {
            $('.panel').lobiPanel({
                sortable: true
            });
            $('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
                $('.dahsboard-column').matchHeight();
            });
        });
    </script>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
