<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_tag".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $tag_post_id
 * @property string $created
 * @property string $updated
 *
 * @property Posts $post
 * @property TagsPost $tagPost
 */
class PostTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_post_id'], 'required'],
            [['post_id', 'tag_post_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['tag_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => TagsPost::className(), 'targetAttribute' => ['tag_post_id' => 'id']],
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
            'tag_post_id' => Yii::t('app', 'Tag Post ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
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
    public function getTagPost()
    {
        return $this->hasOne(TagsPost::className(), ['id' => 'tag_post_id']);
    }
}
