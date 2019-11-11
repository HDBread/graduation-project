<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\base\Model;


class CourseList  extends ActiveRecord {
    
    public $name;
    
    public function rules()
    {
        return [
          
            ['name','required'],
        ];
    }
   
    public static function tableName() {
        return 'courseList';
    }
    
    
    
    public function createCourse()
    {
            $this->courseName = $this->name;
            $this->id_user = \yii::$app->user->identity->id;
            return $this->save();
    }
    

    
}
