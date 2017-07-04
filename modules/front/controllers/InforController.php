<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/24/17
 * Time: 11:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\models\Track;

class InforController extends FrontBaseController{

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

    public function actionIndex()
    {
        
        return $this->render('index',[
         
        ]);
    }

    public function actionInfor() {
        $data                   = json_decode($_POST['data'], true);
        $checkTrack             = Track::find()->where('ip =:ip AND DATE(created) =:created',[':ip'=>$data['ip'], ':created' => date('Y-m-d')])->one();
        if (isset($checkTrack)) {
            if (!isset($checkTrack->user_id))
                $checkTrack->user_id    =  isset(Yii::$app->user->id)?Yii::$app->user->id:'';
            $checkTrack->updated    =  date('Y-m-d H:i:s');
            $checkTrack->save();
        }
        else {
            $track                  = new Track();
            $track->ip              = $data['ip'];
            $track->user_id         = isset(Yii::$app->user->id)?Yii::$app->user->id:'';
            $track->country_code    = $data['country_code'];
            $track->country_name    = $data['country_name'];
            $track->region_code     = $data['region_code'];
            $track->region_name     = $data['region_name'];
            $track->city            = $data['city'];
            $track->zip_code        = $data['zip_code'];
            $track->time_zone       = $data['time_zone'];
            $track->latitude        = $data['latitude'];
            $track->longitude       = $data['longitude'];
            $track->metro_code      = $data['metro_code'];
            $track->agent           = Yii::$app->request->getUserAgent();
            $track->created         = date('Y-m-d H:i:s');
            $track->updated         = date('Y-m-d H:i:s');
            if ($track->save()){
                echo "success";
            } else {
                print_r($track->getErrors());
            }
        }
    }

}