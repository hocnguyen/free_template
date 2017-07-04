<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 6:27 PM
 */
namespace app\modules\front\assets;

use yii\web\AssetBundle;
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $css = [
        'backend/css/separate/pages/login.min.css',
        'backend/css/lib/font-awesome/font-awesome.min.css',
        'backend/css/lib/bootstrap/bootstrap.min.css',
        'backend/css/main.css'
    ];
    public $js = [
        'backend/js/lib/jquery/jquery.min.js',
        'backend/js/lib/tether/tether.min.js',
        'backend/js/lib/bootstrap/bootstrap.min.js',
        'backend/js/plugins.js',
        'backend/js/lib/match-height/jquery.matchHeight.min.js',
        'backend/js/app.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
