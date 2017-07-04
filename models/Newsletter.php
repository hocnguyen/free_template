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
 * This is the model class for table "newsletter".
 *
 * @property integer $id
 * @property string $email
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 */
class Newsletter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['email'], 'required'], 
            [['user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['email'], 'string', 'max' => 125],
            ['email', 'unique', 'message' => Yii::t('app', 'That email address is already subscribed.')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'user_id' => Yii::t('app', 'User ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
