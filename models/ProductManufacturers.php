<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "product_manufacturers".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $manufacturers_id
 * @property string $created
 * @property string $updated
 *
 * @property manufacturers $manufacturer 
 */
class ProductManufacturers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_manufacturers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'manufacturers_id'], 'integer'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'manufacturers_id' => Yii::t('app', 'Manufacturers ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
   public function getManufacturer() 
   { 
       return $this->hasOne(Manufacturers::className(), ['id' => 'manufacturers_id']); 
   } 
}
