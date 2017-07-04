<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 4:33 PM
 */
namespace app\modules\front\components;
use yii\web\Controller;
use Yii;

class FrontBaseController extends Controller
{
    public $layout = 'main';
    public function init() {
        
        if (!\Yii::$app->session['language_app'])
            \Yii::$app->language    = \Yii::$app->func->getLanguagesWeb();
        else
            \Yii::$app->language = \Yii::$app->session['language_app'];
        if (isset($_GET['lang'])) { 
            \Yii::$app->session['language_app'] = $_GET['lang'];
            \Yii::$app->language = \Yii::$app->session['language_app'];
        }

        /*if (isset(Yii::$app->session['keyword_search'])) {
            unset(Yii::$app->session['keyword_search']);
        }*/

        parent::init();
    }
}