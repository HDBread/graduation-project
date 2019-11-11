<?php

namespace app\models;

use yii\base\Model;

class Signup extends model
{
    public $email;
    public $username;
    public $password;
    public $verifyPassword;
    
    //Правила для полей регистрации
    public function rules()
    {
        return [
          
            [['email', 'password', 'verifyPassword', 'username'],'required'],
            ['email','email'],
            [['email', 'username', 'password', 'verifyPassword'],'trim'],
            ['email','unique','targetClass'=>'app\models\User'],
            ['username','unique','targetClass'=>'app\models\User'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            ['verifyPassword','validatePassword'],
            [['password','verifyPassword'],'string','min'=>2, 'max'=>20]
        ];
    }
    
    //Функция изменения названий label у полей
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'username' => 'Логин',
            'password' => 'Пароль',
            'verifyPassword' => 'Подтверждение пароля',
        ];
    }
    
    //Сделать проверку совпадений
    public function validatePassword($attributes, $params)
    {
        if(!$this->hasErrors())
        {            
            if(!($this->password === $this->verifyPassword))
            {
                $this->addError($attributes, 'Пароли не совпадают');
            }
        }
    }
    
    //Метод добавления пользователя в БД, при успешной валидации
    public function signup()
    {      
            $user = new User();
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->username = $this->username;
            return $user->save();
    }    
}