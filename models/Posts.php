<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $image 
 * @property string $description
 * @property string $content
 * @property string $web_url
 * @property integer $is_comment
 * @property integer $is_status
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property PostCate[] $postCates
 * @property PostTag[] $postTags
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'content'], 'string'],
            [['is_comment', 'is_status', 'user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title', 'image', 'web_url'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'), 
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'web_url' => Yii::t('app', 'Web Url'),
            'is_comment' => Yii::t('app', 'Is Comment'),
            'is_status' => Yii::t('app', 'Is Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCates()
    {
        return $this->hasMany(PostCate::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }

    public function getcategories(){
        error_reporting(0);
        $cat = PostCate::find()->where('post_id =:post_id',[':post_id'=>$this->id])->all();
        $listCatProduct ="";
        foreach($cat as $catVideo){
            $categoryn_data = CategoryPost::findOne($catVideo['cate_post_id']);
            $listCatProduct .= Html::a( $categoryn_data->name, Yii::$app->params['url_admin'].'/categorypost/view?id='.$categoryn_data->id )."<br>";
        }
        return $listCatProduct;
    }

    public function gettags(){
        error_reporting(0);
        $cat                = PostTag::find()->where('post_id =:post_id',[':post_id'=>$this->id])->all();
        $listTagsProduct    = "";
        foreach($cat as $catVideo){
            $categoryn_data = TagsPost::findOne($catVideo['tag_post_id']);
            $listTagsProduct .= Html::a( $categoryn_data->name, Yii::$app->params['url_admin'].'/tagspost/view?id='.$categoryn_data->id )."<br>";
        }
        return $listTagsProduct;
    }

    public function getUser(){
        $user = \app\models\User::findIdentity($this->user_id);
        return Html::a( $user->username, Yii::$app->params['url_admin'].'/user/view?id='.$user->id );
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
}
