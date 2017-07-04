<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 2/7/17
 * Time: 5:35 PM
 */
use yii\helpers\Html;
use app\modules\front\assets\LoginAsset;
LoginAsset::register($this);
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>"/>
        <meta name="author" content="VinhTQ">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo Html::csrfMetaTags() ?>
        <title><?php echo isset($this->title)?Html::encode($this->title).'-'.Yii::$app->params['site_admin']:Yii::$app->params['site_admin'] ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php
    echo $content;
    ?>
     <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>