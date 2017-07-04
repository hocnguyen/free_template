<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 4:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use Yii;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\Contacts;
use app\models\ContactForm;
use app\models\Products;
use app\models\Manufacturers;
use app\models\Categories;

class IndexController extends FrontBaseController{

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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {       
        $page_size  = 12;
        $products   = new ActiveDataProvider(
            [
                'query' => Products::find()->where('is_status =:is_status ORDER BY `id` DESC', [':is_status'=>Yii::$app->params['status_active']]),
                'pagination' => [
                    'pageSize' => $page_size,
                ],
            ]);

        $categories = new ActiveDataProvider(
            [
                'query' => Categories::find()->where('is_display =:is_display AND is_hot =:is_hot LIMIT 8', [':is_display'=>Yii::$app->params['status_active'], ':is_hot' => Yii::$app->params['status_active'] ]),
                'pagination' => false,
            ]); 

        return $this->render('index',[
            'products'  => $products,
            'categories'    => $categories
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['support_email'])) {
                $modelC          =  new Contacts();
                $modelC->title   = $_POST['ContactForm']['name'];
                $modelC->email   = $_POST['ContactForm']['email'];
                $modelC->message = $_POST['ContactForm']['body'];
                $modelC->created = date('Y-m-d H:i:s');
                $modelC->updated = date('Y-m-d H:i:s');
                if ($modelC->save()) {
                    Yii::$app->mailer->compose()
                            ->setFrom(Yii::$app->params['support_email'])
                            ->setTo(Yii::$app->params['support_email'])
                            ->setSubject('ContactUs Form Submitted : Email - ' . $modelC->email)
                            ->setSubject('ContactUs Form Submitted : Email - ' . $modelC->email)
                            ->setTextBody('ContactUs Form Submitted : Email - ' . $modelC->email)
                            ->setHtmlBody('<b>Hi Admin,</b> 
                            <p>Someone submitted Contact Us Form with following details: 
                              <ul style="list-style-type:square">
                                <li>Title : ' . $modelC->title . '</li>
                                <li>Email : ' . $modelC->email . '</li>
                                <li>Message : ' . $modelC->message . '</li>
                              </ul>
                            </p> 
                              <br> Regards </br>
                              <br>Team ClickBuyAll.</br>')
                            ->send();
                    Yii::$app->session->setFlash('successContact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                }
                else{
                    Yii::$app->session->setFlash('errorMailContact', 'Error Send Email!');
                }     
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

}