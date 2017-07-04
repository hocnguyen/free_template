<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/11/17
 * Time: 11:55 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\models\HtmlPages;
use app\models\HtmlPagesSearch;


class PageController extends FrontBaseController{

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

       /**
     * Lists all HtmlPages models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( ( $model = HtmlPages::find()->where('pagecode=:pagecode', [':pagecode' => $_GET['alias'] ] )->one() ) )
        {
            Yii::$app->session['menu_footer_active'] = $_GET['alias'];
            return $this->render('index', [
                'model' => $model,
            ]);
        }
        else{
            $this->goHome();
        }
    }


}