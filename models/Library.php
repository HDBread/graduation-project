<?php


namespace app\models;
use yii\db\ActiveRecord;
use yii\base\Model;

/**
 * Description of Library
 *
 * @author User
 */
class Library  extends ActiveRecord {
   
    public static function tableName() {
        return 'library';
    }
    

    public function attributeLabels() {
        return [
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'text' => 'Text',
            'keywords' => 'KeyWords',
            'description' => 'Description',
        ];
    }


//    public function getCourse()
//    {
//        return $this->hasOne(Course::className(), ['id' => 'id_library']);
//    }
    
}