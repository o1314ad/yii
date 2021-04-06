<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $ibsn
 * @property int $pageCount
 * @property string|null $publishedDate
 * @property string|null $shortDescription
 * @property string|null $longDescription
 * @property string|null $img
 * @property string|null $status
 */
class Books extends \yii\db\ActiveRecord
{
    public $categories;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'ibsn'], 'required'],
            [['ibsn'], 'integer'],
            [['pageCount'], 'integer'],
            [['publishedDate'], 'safe'],
            [['shortDescription', 'longDescription'], 'string'],
            [['title'], 'string', 'max' => 140],
            [['img'], 'string', 'max' => 50],
            ['img','file', 'extensions'=>'jpg, png'],
            [['status'], 'string', 'max' => 15],
            [['categories'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'ibsn' => 'Артикул',
            'pageCount' => 'Количество страниц',
            'publishedDate' => 'Дата публикации',
            'shortDescription' => 'Краткое описание',
            'longDescription' => 'Полное описание',
            'img' => 'Обложка',
            'status' => 'Статус',
            'categories' => 'Категории',

        ];
    }

    /*делаем отношения книг и категорий через промежуточную таблицу и отношения через via*/
    public function getBookCategories(){
        return $this->hasMany(Bookscategories::className(), ['book_id'=>'id'] );
    }
    public function getCategory(){
        return  $this->hasMany(Categories::className(),['id'=>'category_id'])->via('bookCategories');
    }
    public function afterFind()
    {
        $this->categories = ArrayHelper::map($this -> category,'name','name');
    }

    public function makeCategory($category){
        if(!$new_category=Categories::find()->andWhere(['name'=>$category])->one()) {
            $new_category = new Categories();
            $new_category->name = $category;
            if (!$new_category->save()) {
                $new_category = null;
            }
        }
        if($new_category!=null){
            $b_c=new Bookscategories();
            $b_c->book_id=$this->id;
            $b_c->category_id=$new_category->id;
            if ($b_c->save())
            {
                return true;
            }
        }
        return false;
    }
    public function updateBooksList($one_item){
        $this->title = $one_item->title;
        $this->ibsn = $one_item->isbn;
        $this->pageCount = $one_item->pageCount;
        $this->publishedDate = date("Y-m-d H:i:s", strtotime($one_item->publishedDate->$date));
        $this->shortDescription = $one_item -> shortDescription;
        $this->longDescription = $one_item->longDescription;
        $this->status=$one_item->status;
        $this->categories=$one_item->categories;

        /*загрузка файлов*/
        if($one_item->thumbnailUrl){
           if($image=file_get_contents($one_item->thumbnailUrl, false, stream_context_create(['http' => ['method'  => 'GET','header'  => "Content-Type: application/json\r\n",'ignore_errors' => TRUE, 'content' => $reqBody]]))){
               $file_name=basename($one_item->thumbnailUrl);
               file_put_contents("../public_html/upload/".$file_name, $image);
               $this->img=$file_name;
           }
        }
        $this->save();
        if(is_array($this->categories)){
            foreach ($this->categories as $key=>$one){
                $this->makeCategory($one);
            }
        }

          }

}
