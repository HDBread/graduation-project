<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
   
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
    
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }
    
    // ============== методы IdentityInterface ==============
    
    //Запрос в базу по полю id
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    
    //Возвращает id найденного пользователя в базе
    public function getId()
    {
        return $this->id;
    }
    
    public static function findIdentityByAccessToken($token, $type = null)  
    {
        
    }
    
    public function getAuthKey()
    {
        
    }
    
    public function validateAuthKey($authKey)
    {
        
    }
    
}
