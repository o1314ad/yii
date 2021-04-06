<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bookscategories".
 *
 * @property int $id
 * @property int $book_id
 * @property int $category_id
 */
class Bookscategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookscategories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'category_id' => 'Category ID',
        ];
    }

    public function getCategories(){
        return $this->hasOne(Categories::className(),['id'=>'category_id']);
    }
}
