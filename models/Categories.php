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
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $image_hot 
 * @property integer $is_hot 
 * @property integer $parent_id
 * @property integer $is_display
 * @property integer $is_order
 * @property string $created
 * @property string $updated
 * 
 * @property ProductCategories[] $productCategories 
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_hot', 'parent_id', 'is_display', 'is_order'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 300],
            [['image', 'image_hot'], 'string', 'max' => 255],
            ['name', 'unique', 'message' => Yii::t('app', 'That name is already categories.')],
            [['image', 'image_hot'], 'file', 'extensions' => 'gif, jpg, png, gif, jpeg, jfif, tiff, bmp, ppm']
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
            'image' => Yii::t('app', 'Icon'),
            'image_hot' => Yii::t('app', 'Image'),
            'is_hot' => Yii::t('app', 'Is Hot'),
            'parent_id' => Yii::t('app', 'Parent Category'), 
            'is_display' => Yii::t('app', 'Is Display'),
            'is_order' => Yii::t('app', 'Is Order'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategories::className(), ['category_id' => 'id']);
    }

    public function getImageurl()
    {
        if ($this->image) {
            return Html::img('/uploads/categories/'.$this->image, ['width'=>'24', 'class'=>'imageresource']);
        }
    }

    public function getImageurlhot()
    {
        if ($this->image_hot) {
            return Html::img('/uploads/categories/'.$this->image_hot, ['width'=>'150', 'class'=>'imageresource'] );
        }
    }

    public function getParentCategory() {
        if ($this->parent_id != 0) {
            $parent_category = Categories::find()->where('id =:parent_id',['parent_id'=>$this->parent_id])->one();
            return Html::a( $parent_category->name, [Yii::$app->params['url_admin'].'/categories/view?id='.$this->parent_id] );
        }
    }

    public function getDisplay()
    {
        $str = "Disable";
        if( $this->is_display )
            $str = "Enable";
        return $str;
    }

    public function getHot()
    {
        $str = "Disable";
        if( $this->is_hot )
            $str = "Enable";
        return $str;
    }

}
