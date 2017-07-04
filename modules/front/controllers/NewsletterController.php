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
use app\models\Newsletter;
use app\models\NewsletterSearch;

class NewsletterController extends FrontBaseController{

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

     public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
        ];
    }

    public function actionIndex()
    {      
        if (Yii::$app->request->isAjax) {
          $data   = Yii::$app->request->post();
          $email  = $data['email']; 
          $model = new Newsletter();
          if (isset($email) && Yii::$app->func->isValidEmail($email)) {
              $model->email    = stripcslashes($email);
              $model->created  = date('Y-m-d H:i:s');
              $model->updated  = date('Y-m-d H:i:s');
              if( $model->save() )
                  $result = 'success';
              else{
                  $result = 'error';
               }   
          } 
           else{
                  $result = 'error';
               } 
          return $result;     
        }
    }

}