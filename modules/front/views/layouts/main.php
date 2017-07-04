<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 4:35 PM
 */
use yii\helpers\Html;
use app\modules\front\assets\AppAsset;
AppAsset::register($this);
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>"/>
        <meta name="author" content="Earn">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags() ?>
        <title><?php echo Yii::t('app','Download Free Premium Tempalte, Scripts, Wordpress Plugins, Mobile Games and Apps, Ebook') ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?php echo yii\web\View::render('../elements/header'); ?>
    <?php
        echo $content;
    ?>
    <?php echo yii\web\View::render('../elements/footer'); ?>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>