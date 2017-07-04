<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;
use yii\helpers\Html;
use app\models\Mail;
use app\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email'  => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                $templateEmail = Mail::find()->where('type =:type AND is_status =:is_status',[':type'=>"Verification Change Password", ':is_status' => Yii::$app->params['status_active'] ])->one();        
                    \Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['support_email'])
                    ->setTo($user->email)
                    ->setSubject($templateEmail->subject)
                    ->setHtmlBody(
                        \Yii::t('app', $templateEmail->mail_body, [
                            'name'              => $user->fname.' '.$user->lname,
                            'link'              => Html::a(Yii::t('app','Active change password'),Yii::$app->params['domain-company'].'/reset-password?token='.$user->password_reset_token),
                            'domain-company'    => Yii::$app->params['domain-company']
                        ])
                    )->send();            
            }
        }

        return false;
    }
}
