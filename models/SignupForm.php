<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fname;
    public $lname;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['fname', 'required'],
            ['lname', 'required'],
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha', 'captchaAction'=>'front/users/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fname'         => 'First Name',
            'lname'         => 'Last Name',
            'verifyCode'    => 'Verification Code',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username     = $this->username;
        $user->email        = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->lname        = $this->lname;
        $user->fname        = $this->fname;
        $user->status       = User::STATUS_DELETED;
        $user->created      = date('Y-m-d H:i:s');
        $user->updated      = date('Y-m-d H:i:s');
        $user->verify_key   = md5(date('Y-m-d H:i:s'));

        return $user->save() ? $user : null;
    }
}
