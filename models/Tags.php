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
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $total
 * @property string $term_group
 * @property string $created
 * @property string $updated
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['total', 'term_group'], 'integer'],
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
            'term_group' => Yii::t('app', 'Term Group'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
