<?php
namespace app\modules\front\controllers;

use app\modules\front\components\FrontBaseController;
use Yii;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\Mail;
use app\models\User;

class UsersController extends FrontBaseController{

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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdmin(){
        if (\Yii::$app->user->id && User::isUserAdmin(\Yii::$app->user->identity->username)) {
            return $this->redirect('/admin-cp');
        }
        $this->layout ='admin';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->loginAdmin())
                return $this->redirect('/admin-cp');
            else
                \Yii::$app->session->setFlash('errorLogin', 'Sorry, But we can\'t find a member with those login information.');
        }
        return $this->render('admin', [
            'model' => $model,
        ]);

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLogin()
    {
        if (\Yii::$app->user->id) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ( $model->load(\Yii::$app->request->post()) ) {
            if ($model->login()) {
                return $this->goBack();
            }
            else{
                \Yii::$app->session->setFlash('error_login', 'Incorrect Username or Password!');
            }
        }
        return $this->render('login', [
               'model' => $model
            ]);
    }
    
    public function actionLostpassword(){
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success_request_password', 'Check your email for further instructions.');
            } else {
                Yii::$app->session->setFlash('success_request_password', 'Check your email for further instructions.');
                //Yii::$app->session->setFlash('error_request_password', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

      /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetpassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success_reset_password', 'New password saved. Please login system!');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {

                    $templateEmail = Mail::find()->where('type =:type AND is_status =:is_status',[':type'=>"REGISTRATION CONFIRMATION", ':is_status' => Yii::$app->params['status_active'] ])->one();        
                    \Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['support_email'])
                    ->setTo($user->email)
                    ->setSubject($templateEmail->subject)
                    ->setHtmlBody(
                        \Yii::t('app', $templateEmail->mail_body, [
                            'name'              => $user->fname.' '.$user->lname,
                            'name-company'      => Yii::$app->params['site_name'],
                            'link_active'       => Html::a(Yii::t('app','Active your account'),Yii::$app->params['domain-company'].'/users/verifying-email?verifyKey='.$user->verify_key),
                            'domain-company'    => Yii::$app->params['domain-company']
                        ])
                    )->send();            

                \Yii::$app->session->setFlash('success_regsiter', 'Please check Email for active your account!');
            } else {
                \Yii::$app->session->setFlash('error_regsiter', 'Error Register!');
            }
        }

        return $this->render('register', [
                'modelSignup' => $model,
            ]);
    }

    public function actionVerify()
    {
        $key    = stripcslashes($_GET['verifyKey']);
        $user   = User::find()->where('verify_key =:verify_key',[':verify_key'=>$key])->one();
        if ($user)
        {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()){
                \Yii::$app->session->setFlash('success_active_account', 'Success active your Account! Please Login.');
            } else {
                 \Yii::$app->session->setFlash('error_active_account', 'Error active your Account!');
            }
        } 
        else {
            \Yii::$app->session->setFlash('error_active_account', 'Error active your Account!');
        }
        return $this->render('verify');
    }


}