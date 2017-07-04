<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tags_post".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $total
 * @property string $created
 * @property string $updated
 *
 * @property PostTag[] $postTags
 */
class TagsPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['total'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['name', 'unique', 'message' => Yii::t('app', 'That name is already tags.')],
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
            'slug' => Yii::t('app', 'Slug'),
            'total' => Yii::t('app', 'Total'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['tag_post_id' => 'id']);
    }

    public static function getAllTagsById($id){
        $data = Yii::$app->db->createCommand("SELECT tags_post.name FROM tags_post INNER JOIN post_tag WHERE tags_post.`id` = post_tag.`tag_post_id` AND post_tag.`post_id` = ".$id." ORDER BY tags_post.id DESC")->queryColumn();
        return $data;
    }
}
