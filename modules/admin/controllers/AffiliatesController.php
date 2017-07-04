<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 4/7/17
 * Time: 9:50 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;

/**
 * UserController implements the CRUD actions for User model.
 */
class AffiliatesController extends AdminBaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
       if(!\Yii::$app->user->id)
            return $this->goHome();

        return $this->render('index',[
        
        ]);
    }

}
