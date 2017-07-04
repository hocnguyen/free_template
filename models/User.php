<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Html;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $last_logged
 * @property integer $is_online
 * @property string $fname
 * @property string $lname
 * @property string $address
 * @property string $phone
 * @property string $image
 * @property string $verify_key
 * @property integer $id_read
 * @property string $created
 * @property string $updated
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED    = 0;
    const STATUS_ACTIVE     = 10;
    const USER_ONLINE       = 1;
    const USER_OFFLINE      = 0;
    const ROLE_USER         = 10;
    const ROLE_ADMIN        = 20;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['role', 'status', 'created_at', 'updated_at', 'is_online', 'id_read'], 'integer'],
            [['last_logged', 'created', 'updated'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'fname', 'lname', 'address', 'phone','image', 'verify_key'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
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
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'last_logged' => Yii::t('app', 'Last Logged'),
            'is_online' => Yii::t('app', 'Is Online'),
            'fname' => Yii::t('app', 'First name'),
            'lname' => Yii::t('app', 'Last name'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'image' => Yii::t('app', 'Image'),
            'verify_key' => Yii::t('app', 'Verify Key'),
            'id_read' => Yii::t('app', 'Is Read'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Created'),
        ];
    }

    public function getDisplay()
    {
         $str = "Unactive";
        if( $this->status )
            $str = "Active";
        return $str;
    }

    public function getRoleUser()
    {
        $str = Yii::t('app','Customer');
        if( $this->role == User::ROLE_ADMIN )
            $str = Yii::t('app','Admin');
        return $str;
    }

    public function getImageurl()
    {
        if ($this->image) {
            return "<img style='border-radius: 50%; background:url(/".$this->image.");background-size:cover;background-position: center; width:64px;' src='".Yii::getAlias('@back')."/img/blank.gif'>";
        } else {
            return Html::img(Yii::getAlias('@back').'/img/avatar-1-64.png', ['width'=>'64', 'class'=>'imageresource'] );
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function isUserAdmin($username)
    {
          if (static::findOne(['username' => $username, 'role' => self::ROLE_ADMIN, 'status' => self::STATUS_ACTIVE])){
     
                 return true;
          } else {
     
                 return false;
          }
     
    }

    public static function isUser($username)
    {
          if (static::findOne(['username' => $username, 'role' => self::ROLE_USER, 'status' => self::STATUS_ACTIVE]) || static::findOne(['email' => $username, 'role' => self::ROLE_USER, 'status' => self::STATUS_ACTIVE ]) ){
     
                 return true;
          } else {
     
                 return false;
          }
     
    }

    public static function short_title( $title = '', $limit = 5 ){
        if (strlen($title) > $limit) {
            $title=substr($title, 0, $limit);
            return $title=substr($title,0,strrpos($title,' '));

        }
        else {
            return  $title;
        }
    }

    public function updateStatusOnline(){
        $table_members = $this->tableName();
        Yii::$app->db->createCommand()
            ->update($table_members,
                array( 'last_logged'=> new Expression('NOW()'), 'is_online' => User::USER_ONLINE ),
                'id=:id', array( ':id'=>Yii::$app->user->id )
            );
    }

    public static function statusOnline( $online ){
        $user = Lookup::find()->where('type = "StatusOnline" AND code =:code',[':code'=>$online])->one();
        return $user->name;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user               = new User();
            $user->username     = $this->username;
            $user->email        = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public static function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getRead()
    {
        $str = Yii::t('app',"Unread");
        if( $this->id_read )
            $str = Yii::t('app',"Read");
        return $str;
    }

}
