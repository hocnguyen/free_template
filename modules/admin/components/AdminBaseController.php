<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:22 PM
 */
namespace app\modules\admin\components;
use app\models\User;
use yii\web\Controller;

class AdminBaseController extends Controller
{
    /**
     * admins breadcrumbs
     */
    public $breadcrumbs = array();
    public $layout = 'main';
    public function init(){

        $username = isset(\Yii::$app->user->identity->username)?\Yii::$app->user->identity->username:'';
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        } else if( \Yii::$app->user->id && !User::isUserAdmin($username)){
            return $this->goHome();
        }

        if( !\Yii::$app->session['language_front'] )
            \Yii::$app->language    = \Yii::$app->func->getLanguagesWeb();
        else
            \Yii::$app->language = \Yii::$app->session['language_front'];
        if( isset($_GET['lang'])){ 
            \Yii::$app->session['language_front'] = $_GET['lang'];
            \Yii::$app->language = \Yii::$app->session['language_front'];
        }
        parent::init();
    }
}