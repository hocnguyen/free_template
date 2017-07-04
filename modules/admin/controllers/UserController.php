<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/21/17
 * Time: 9:16 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AdminBaseController
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $queryParams = array_merge(array(),Yii::$app->request->getQueryParams());
        $queryParams["UserSearch"]["role"] = User::ROLE_USER;
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->id_read = 1;
        $model->save();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile       = UploadedFile::getInstance($model, 'image');
            $rnd                = rand(0,9999);
            $fileName           = "{$rnd}-{$uploadedFile}";
            $folderProcedure    = \Yii::getAlias('@RealDirectory').'/web/uploads/customers/';
            if(!is_dir($folderProcedure)){
                mkdir($folderProcedure, 0777);
            }
            if (!empty($uploadedFile)) {
                $model->image   = 'uploads/customers/'.$fileName;
            }
            $model->setPassword($_POST['User']['password_hash']);
            $model->generateAuthKey();
            $model->created     = date('Y-m-d H:i:s');
            $model->updated     = date('Y-m-d H:i:s');
            if ($model->save()){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/customers/' .$fileName);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp  = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'image');
            if(!empty($uploadedFile)) {
                $rnd                = rand(0,9999);
                $fileName           = "{$rnd}-{$uploadedFile}";
                $model->image       = 'uploads/customers/'.$fileName;
            }
            else{
                $model->image       = $temp;
            }
            $model->updated         = date('Y-m-d H:i:s');
            if ($model->save()) {
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/customers/' .$fileName);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAdmin()
    {

        $searchModel = new UserSearch();
        $queryParams = array_merge(array(),Yii::$app->request->getQueryParams());
        $queryParams["UserSearch"]["role"] = User::ROLE_ADMIN;

        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChangepass()
    {
        $user = User::findOne([
            'status'    => User::STATUS_ACTIVE,
            'role'      => User::ROLE_ADMIN,
            'id'        => \Yii::$app->user->id
        ]);

        if ($user) {   
            $user->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
            $user->save();

            try {
                $model = new ResetPasswordForm($user->password_reset_token);
            } catch (InvalidParamException $e) {
                throw new BadRequestHttpException($e->getMessage());
            }

            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                Yii::$app->session->setFlash('success_change_pass', 'New password saved.');
            }
            return $this->render('change_pass', [
                'model' => $model,
            ]);
        }      
        
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
