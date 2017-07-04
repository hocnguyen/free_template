<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/8/17
 * Time: 11:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\models\HtmlPages;

class HelpcenterController extends FrontBaseController{

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

    public function actions()
    {
        return [
          
        ];
    }

    public function actionIndex($alias)
    {
        $data = HtmlPages::find()->where('pagecode =:pagecode AND is_status =:is_status',[':pagecode'=>$alias, ':is_status' => Yii::$app->params['status_active']])->one();
        
        return $this->render('index',[
            'data'          => $data,
        ]); 
    }

}