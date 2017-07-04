<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_post".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_status
 * @property string $created
 * @property string $updated
 *
 * @property PostCate[] $postCates
 */
class CategoryPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'message' => Yii::t('app', 'That name is already categories.')],
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
            'is_status' => Yii::t('app', 'Is Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCates()
    {
        return $this->hasMany(PostCate::className(), ['cate_post_id' => 'id']);
    }

    public function getDisplay()
    {
        $str = "Disable";
        if( $this->is_status )
            $str = "Enable";
        return $str;
    }
}
