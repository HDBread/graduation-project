<?php
namespace app\models;
use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;
    public $username;
    
    public function rules()
    {
        return [
            [['email','password'],'required'],
            //['email','email'],
            ['password','validatePassword']
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'email' => 'Email/Логин',
            'password' => 'Пароль',
        ];
    }
    
    public function validatePassword($attribute, $params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();

            if(!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Пароль или email/логин введены неверно');
            }
        }
    }
    
    public function getUser()
    {
         return User::find()
                 ->where(['username' => $this->email])
                 ->orWhere(['email' => $this->email])
                 ->one();
         
    }
    
}