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
 * This is the model class for table "product_tags".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $tag_id
 * @property integer $count
 * @property string $created
 * @property string $updated

 * @property Products $product 
 * @property Tags $tag 
 */
class ProductTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'tag_id', 'count'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']], 
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
            'tag_id' => Yii::t('app', 'Tag ID'),
            'count' => Yii::t('app', 'Count'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
   public function getTag() 
   { 
       return $this->hasOne(Tags::className(), ['id' => 'tag_id']); 
   } 

    public static function getAllTagsById($id){
        $data = Yii::$app->db->createCommand("SELECT tags.name FROM tags INNER JOIN product_tags WHERE tags.`id` = product_tags.`tag_id` AND product_tags.`product_id` = ".$id." ORDER BY tags.id DESC")->queryColumn();
        return $data;
    }
}
