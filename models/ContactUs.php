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
 * This is the model class for table "contact_us".
 *
 * @property integer $id
 * @property string $title
 * @property string $email
 * @property string $message
 * @property integer $id_read
 * @property string $created
 * @property string $updated
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['id_read'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title', 'email'], 'string', 'max' => 255],
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
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Message'),
            'id_read' => Yii::t('app', 'Id Read'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
