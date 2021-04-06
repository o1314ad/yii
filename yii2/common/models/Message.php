<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property string $message
 * @property string|null $phone
 */
class Message extends \yii\db\ActiveRecord
{
    public $captcha;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'message'], 'required'],
            [['message'], 'string', 'min'=> 10, 'max'=>1000],
            [['email', 'name', 'phone'], 'string', 'max' => 50],
            ['email','email'],
            ['captcha', 'captcha', 'captchaAction' =>'/message/captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Введите свой e-mail (обязательное поле)',
            'name' => 'Введите своё имя',
            'message' => 'Введите текст сообщения (обязательное поле)',
            'phone' => 'Введите номер телефона',
        ];
    }

    /* письмо на почту заполнителя заявки*/
    public function contact($new_mail)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setFrom([$new_mail])
                ->setTo($this->email)
                ->setSubject("Письмо с сайте")
                ->setTextBody('От:'.$this->name."\r\n Сообщение:".$this->message)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}
