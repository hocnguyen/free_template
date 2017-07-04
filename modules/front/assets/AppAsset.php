<?php
/**
 * Created by PhpStorm.
 * User: Earn
 * Date: 3/10/16
 * Time: 6:25 AM
 */
namespace app\modules\front\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'front/css/animate.css',
        'front/css/template.css',
        'front/owl-carousel/owl.carousel.css',
        'front/owl-carousel/owl.theme.css',
        'front/css/responsive.css',
        'front/css/custom.css',
    ];
    public $js = [
        'front/js/bootstrap.min.js',
        'front/js/jquery.cookie.js',
        'front/js/jquery.hoverIntent.minified.js',
        'front/js/jquery.dcjqaccordion.2.7.min.js',
        'front/js/isotope.pkgd.min.js',
        'front/js/script.js',
        'front/owl-carousel/owl.carousel.min.js',
        'front/js/html5shiv.min.js',
        'front/js/respond.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}