<?php

namespace app\models;
use yii\base\Model;

class Cabinet extends Model
{
    public $email;
    public $username;
    public $name;
    public $surname;
    
    
    public function rules()
    {
        return [
            [['email','username'],'required'],
            ['email','email'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            
        ];
    }
    
    
    
}