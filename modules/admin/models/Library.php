<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "library".
 *
 * @property int $id
 * @property string $title
 * @property string $excerpt
 * @property string $text
 * @property string $keywords
 * @property string $description
 */
class Library extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'excerpt', 'text'], 'required'],
            [['text'], 'string'],
            [['title', 'excerpt', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'text' => 'Text',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }
}
