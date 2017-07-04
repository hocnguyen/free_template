<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;
use app\models\ProductPics;
use app\models\ProductManufacturers;
use app\models\ProductCategories;
use app\models\Tags;
use app\models\ProductTags;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends AdminBaseController
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            $folderProducts                 = \Yii::getAlias('@RealDirectory').'/web/uploads/products';
            if(!is_dir($folderProducts)){
                mkdir($folderProducts, 0777);
            }

            $rnd                            = rand(0,9999);
            $link_images                    = 'uploads/products/'.date("Ymd").'/';

            $folderDetailProducts           = $folderProducts.'/'.date("Ymd");
            if(!is_dir($folderDetailProducts)){
                mkdir($folderDetailProducts, 0777);
            }
            $uploadedFileCover              = UploadedFile::getInstance($model, 'image');
            $fileNameCover                  = "{$rnd}-{$uploadedFileCover}";
            $model->image                   = $link_images.$fileNameCover;

            $model->created_by              = \Yii::$app->user->id;
            $model->updated_by              = \Yii::$app->user->id;
            $model->created                 = date('Y-m-d H:i:s');
            $model->updated                 = date('Y-m-d H:i:s');
            if ( $model->save() ) {

                $cats = isset($_POST['Products']['category'])?$_POST['Products']['category']:[];
                if( $cats ){
                    foreach ($cats as $cat_id){
                        $cat                = new ProductCategories();
                        $cat->product_id    = $model->id;
                        $cat->category_id   = $cat_id;
                        if( $cat->save() )
                            \Yii::$app->session->setFlash('SuccessAddCategories','Add categories success!');
                        else{
                            print_r($cat->getErrors());
                            exit;
                        }
                    }  
                }
                        
                $manu = isset($_POST['Products']['manufacturer'])?$_POST['Products']['manufacturer']:[];
                if( count($manu) > 0 ){
                    foreach ($manu as $manu_id){
                        $cat                    = new ProductManufacturers();
                        $cat->product_id        = $model->id;
                        $cat->manufacturers_id  = $manu_id;
                        if( $cat->save() )
                            \Yii::$app->session->setFlash('SuccessAddManufacturer','Add Manufacturer success!');
                        else{
                            print_r($cat->getErrors());
                            exit;
                        }
                    }  
                } 

                $tags = isset($_POST['Products']['tags'])?$_POST['Products']['tags']:[];
                if( count($tags) > 0 ){
                    foreach ($tags as $tag){
                        $check                              =  Tags::find()->where('id =:id',[':id'=>$tag])->one();
                        if ($check) {
                            $check->total                   += 1;
                            $check->updated                 = date('Y-m-d H:i:s');
                            if ($check->save()) {
                                $productTags                = new ProductTags();
                                $productTags->product_id    = $model->id;
                                $productTags->tag_id        = $check->id;
                                $productTags->created       = date('Y-m-d H:i:s');
                                $productTags->updated       = date('Y-m-d H:i:s');
                                $productTags->save();
                            }
                            else{
                                print_r($check->getErrors());
                                exit;
                            }
                        }
                        else {
                            $model_tag                    = new Tags();            
                            $model_tag->name              = $tag;
                            $model_tag->slug              = \Yii::$app->func->makeAlias($tag);
                            $model_tag->total             = 1;
                            $model_tag->created            = date('Y-m-d H:i:s');
                            $model_tag->updated            = date('Y-m-d H:i:s');
                            if ($model_tag->save()){
                                $productTags              = new ProductTags();
                                $productTags->product_id  = $model->id;
                                $productTags->tag_id      = $model_tag->id;
                                $productTags->created      = date('Y-m-d H:i:s');
                                $productTags->updated      = date('Y-m-d H:i:s');
                                $productTags->save();
                            }
                            else{
                                print_r($model_tag->getErrors());
                                exit;
                            }
                        }
                        
                    } 
                }   


                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFileCover)){
                        $uploadedFileCover->saveAs(Yii::$app->basePath.'/web/'.$link_images.$fileNameCover);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
                }                     
            else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model          = $this->findModel($id);
        $image          = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $rnd                            = rand(0,9999);
            $link_images                    = 'uploads/products/'.date("Ymd").'/';
            $uploadedFile                   = UploadedFile::getInstance($model, 'image');
            if(!empty($uploadedFile)) {
                $fileName           = "{$rnd}-{$uploadedFile}";
                $model->image       = $link_images.$fileName;
            }
            else{
                $model->image       = $image;
            }

            $model->updated_by      = \Yii::$app->user->id;
            $model->updated         = date('Y-m-d H:i:s');
            if ($model->save()){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/'.$link_images.$fileName);
                    }
                }

                ProductCategories::deleteAll(
                "product_id = :product_id",
                array(':product_id' => $model->id)
                );
                $cats = isset($_POST['Products']['category'])?$_POST['Products']['category']:[];
                if( count($cats) > 0 ){
                    foreach ($cats as $cat_id){
                        $cat = new ProductCategories();
                        $cat->product_id    = $model->id;
                        $cat->category_id   = $cat_id;
                        if( $cat->save() )
                            \Yii::$app->session->setFlash('SuccessAddCategories','Add categories success!');
                        else{
                            print_r($cat->getErrors());
                            exit;
                        }
                    }
                }

                ProductManufacturers::deleteAll(
                "product_id = :product_id",
                array(':product_id' => $model->id)
                );
                $manu = isset($_POST['Products']['manufacturer'])?$_POST['Products']['manufacturer']:[];
                if (count($manu) > 0){
                    foreach ($manu as $manu_id){
                        $cat                    = new ProductManufacturers();
                        $cat->product_id        = $model->id;
                        $cat->manufacturers_id  = $manu_id;
                        if ($cat->save())
                            \Yii::$app->session->setFlash('SuccessAddManufacturer','Add Manufacturer success!');
                        else{
                            print_r($cat->getErrors());
                            exit;
                        }
                    } 
                }   

                ProductTags::deleteAll(
                "product_id = :product_id",
                array(':product_id' => $model->id)
                );
                $tags = isset($_POST['Products']['tags'])?$_POST['Products']['tags']:[];
                if( count($tags) > 0 ){
                    foreach ($tags as $tag){
                        $check                              =  Tags::find()->where('id =:id',[':id'=>$tag])->one();
                        if ($check) {
                            $check->updated                 = date('Y-m-d H:i:s');
                            if ($check->save()) {
                                $productTags                = new ProductTags();
                                $productTags->product_id    = $model->id;
                                $productTags->tag_id        = $check->id;
                                $productTags->created       = date('Y-m-d H:i:s');
                                $productTags->updated       = date('Y-m-d H:i:s');
                                $productTags->save();
                            }
                            else{
                                print_r($check->getErrors());
                                exit;
                            }
                        }
                        else {
                            $model_tag                    = new Tags();            
                            $model_tag->name              = $tag;
                            $model_tag->slug              = \Yii::$app->func->makeAlias($tag);
                            $model_tag->total             = 1;
                            $model_tag->created            = date('Y-m-d H:i:s');
                            $model_tag->updated            = date('Y-m-d H:i:s');
                            if ($model_tag->save()){
                                $productTags              = new ProductTags();
                                $productTags->product_id  = $model->id;
                                $productTags->tag_id      = $model_tag->id;
                                $productTags->created      = date('Y-m-d H:i:s');
                                $productTags->updated      = date('Y-m-d H:i:s');
                                $productTags->save();
                            }
                            else{
                                print_r($model_tag->getErrors());
                                exit;
                            }
                        }
                        
                    } 
                }   

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                return $this->render('update', [
                'model' => $model,
                ]);
             }   
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
