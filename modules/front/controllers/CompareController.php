<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/27/17
 * Time: 10:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;
use app\models\Compares;
use app\models\ComparesSearch;

class CompareController extends FrontBaseController{

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

    public function actionIndex($id)
    {       
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to save your compare');
            $this->redirect(['/login']);
        }

        $check = Compares::find()->where('user_id =:user_id AND product_id =:product_id',[':user_id' => Yii::$app->user->id, ':product_id' => intval($id)])->one();
        if ($check) {
            \Yii::$app->session->setFlash('exist_wishlist', 'That product is already your compare');
        } else {
            $model              = new Compares();
            $model->user_id     = Yii::$app->user->id;
            $model->product_id  = intval($id);
            $model->created     = date('Y-m-d H:i:s');
            $model->updated     = date('Y-m-d H:i:s');
            $model->save();
        }            
    }

    public function actionCompare () {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to save your compare');
            $this->redirect(['/login']);
        }
        $page_size  = 10;

        $products   = new SqlDataProvider([
                    'sql' => 'SELECT products.* FROM products INNER JOIN compares ON products.id = compares.`product_id` WHERE compares.`user_id` = '.intval(Yii::$app->user->id).' ORDER BY products.id DESC LIMIT 3',
                    'pagination' => false
        ]);
        return $this->render('index',[
                'products' => $products
        ]);
    }

    public function actionRemove ($id) {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to save your compare');
            $this->redirect(['/login']);
        }

        $check = Compares::find()->where('user_id =:user_id AND product_id =:product_id',[':user_id' => Yii::$app->user->id, ':product_id' => intval($id)])->one();
        if ($check) {
            $check->delete();
        }
    }

}