<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_cate".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $cate_post_id
 *
 * @property Posts $post
 * @property CategoryPost $catePost
 */
class PostCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_cate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'cate_post_id'], 'required'],
            [['post_id', 'cate_post_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['cate_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryPost::className(), 'targetAttribute' => ['cate_post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'cate_post_id' => Yii::t('app', 'Cate Post ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatePost()
    {
        return $this->hasOne(CategoryPost::className(), ['id' => 'cate_post_id']);
    }
}
