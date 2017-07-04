<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/2017
 * Time: 11:43 AM
 */
namespace app\modules\front\controllers;

use app\modules\front\components\FrontBaseController;
use Yii;

class ErrorController extends FrontBaseController {

    public function actionIndex() {
        return $this->render('error');
    }


}