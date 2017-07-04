<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property string $sku
 * @property string $image
 * @property double $price
 * @property double $special_price
 * @property string $url_video
 * @property integer $is_status
 * @property integer $is_wishlist
 * @property string $short_description
 * @property string $full_dsscription
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 * 
 * @property ProductReviews[] $productReviews
 * @property ProductCategories[] $productCategories 
 * @property ProductManufacturers[] $productManufacturers
 * @property ProductTags[] $productTags
 * @property OrderItems[] $orderItems
 */
class Products extends \yii\db\ActiveRecord
{
    
    public $category;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price', 'special_price'], 'number'],
            [['is_status', 'is_wishlist', 'created_by', 'updated_by'], 'integer'],
            [['short_description', 'full_dsscription'], 'string'],
            [['created', 'updated'], 'safe'],
            [['name', 'url_video'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 100],
            ['sku', 'unique', 'message' => Yii::t('app', 'That sku is already products.')],
            [['image'], 'file', 'extensions' => 'gif, jpg, png, gif, jpeg, jfif, tiff, bmp, ppm']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'image' => Yii::t('app', 'Image'),
            'price' => Yii::t('app', 'Price'),
            'special_price' => Yii::t('app', 'Special Price'),
            'url_video' => Yii::t('app', 'Url Video'),
            'is_status' => Yii::t('app', 'Is Status'),
            'is_wishlist' => Yii::t('app', 'Is Wishlist'),
            'short_description' => Yii::t('app', 'Short Description'),
            'full_dsscription' => Yii::t('app', 'Full Description'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductReviews()
    {
        return $this->hasMany(ProductReviews::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategories::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductManufacturers()
    {
        return $this->hasMany(ProductManufacturers::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTags::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
    }

    public function getImageurl()
    {
        return Html::a( Html::img('/'.$this->image, ['width'=>'90', 'class'=>'imageresource'] ), [''], ['class'=>'img_src_modal'] );
    }

    public function getActive()
    {
        $str = "Disable";
        if( $this->is_status )
            $str = "Enable";
        return $str;
    }

    public function getcategories(){
        error_reporting(0);
        $cat = ProductCategories::find()->where('product_id =:product_id',[':product_id'=>$this->id])->all();
        $listCatProduct ="";
        foreach($cat as $catVideo){
            $categoryn_data = Categories::findOne($catVideo['category_id']);
            $listCatProduct .= Html::a( $categoryn_data->name, Yii::$app->params['url_admin'].'/categories/view?id='.$categoryn_data->id )."<br>";
        }
        return $listCatProduct;
    }

    public function getmanufacturer(){
        error_reporting(0);
        $cat            = ProductManufacturers::find()->where('product_id =:product_id',[':product_id'=>$this->id])->all();
        $listManuProduct ="";
        foreach($cat as $catVideo){
            $categoryn_data = Manufacturers::findOne($catVideo['manufacturers_id']);
            $listManuProduct .= Html::a( $categoryn_data->name, Yii::$app->params['url_admin'].'/manufacturers/view?id='.$categoryn_data->id )."<br>";
        }
        return $listManuProduct;
    }

    public function gettags(){
        error_reporting(0);
        $cat                = ProductTags::find()->where('product_id =:product_id',[':product_id'=>$this->id])->all();
        $listTagsProduct    = "";
        foreach($cat as $catVideo){
            $categoryn_data = Tags::findOne($catVideo['tag_id']);
            $listTagsProduct .= Html::a( $categoryn_data->name, Yii::$app->params['url_admin'].'/tags/view?id='.$categoryn_data->id )."<br>";
        }
        return $listTagsProduct;
    }

    public function getPhotos(){
        error_reporting(0);
        $data = ProductPics::find()->where('product_id =:product_id',[':product_id'=>$this->id])->all();
        $listPhotoProduct    = "";
        foreach($data as $photo){
            $listPhotoProduct       .= Html::img('/'.$photo->image_path, ['width'=>'90', 'class'=>'imageresourceg'] );
        }
        return $listPhotoProduct;
    }

    public function getRetailPrice()
    {
       return Yii::$app->func->formatPrice($this->price);
    }

    public function getSpecialPrice()
    {
       return Yii::$app->func->formatPrice($this->special_price);
    }

    public function getStatsNameProduct($data) {
        return Html::a( $data['name'], Yii::$app->params['url_admin'].'/products/view?id='.$data['id'] ); 
    }

}
