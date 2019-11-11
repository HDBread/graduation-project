<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\base\Model;


class Course  extends ActiveRecord {
    
    public $courseName;
    public $publicationName;
    
//    public function rules()
//    {
//        return [
//          
//            ['name','required'],
//        ];
//    }
   
    public static function tableName() {
        return 'course';
    }
    
    public function getLibrarys()
    {
        return $this->hasMany(Library::className(), ['id' => 'id_library'])->one();
    }
    
    
    
    public function addPublicationInCourse($id_courseList, $id_publication)
    {
        $this->id_courseList = $id_courseList;
        $this->id_library = $id_publication;
        return $this->save();
    }
}