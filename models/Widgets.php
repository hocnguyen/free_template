<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property integer $is_active
 * @property string $created
 * @property string $updated
 */
class Widgets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widgets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['is_active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title'], 'string', 'max' => 100],
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
            'content' => Yii::t('app', 'Content'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getDisplay()
    {
        $str = "Unactive";
        if( $this->is_active )
            $str = "Active";
        return $str;
    }

}
