<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 01/21/17
 * Time: 8:32 PM
 */
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $css = [
        'backend/css/lib/lobipanel/lobipanel.min.css',
        'backend/css/separate/vendor/lobipanel.min.css',
        'backend/css/lib/jqueryui/jquery-ui.min.css',
        'backend/css/separate/pages/widgets.min.css',
        'backend/css/lib/font-awesome/css/font-awesome.css',
        'backend/css/lib/bootstrap/bootstrap.min.css',
        'backend/css/main.css',
        'backend/css/lib/bootstrap-table/bootstrap-table.min.css',
        'backend/css/lib/datatables-net/datatables.min.css',
        'backend/css/separate/vendor/datatables-net.min.css',
        'backend/css/fileinput.css',
        'backend/css/bootstrap-tagsinput.css',
        'backend/css/custom.css'
    ];
    public $js = [
        'backend/js/lib/jquery/jquery.min.js',
        'backend/js/lib/tether/tether.min.js',
        'backend/js/plugins.js',
        'backend/js/lib/jqueryui/jquery-ui.min.js',
        'backend/js/lib/lobipanel/lobipanel.min.js',
        'backend/js/lib/match-height/jquery.matchHeight.min.js',
        'https://www.gstatic.com/charts/loader.js',
        'backend/js/app.js',
        'backend/js/fileinput.js',
        'backend/js/bootstrap-tagsinput.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}