<?php
namespace console\controllers;

use common\models\Books;

class BooksController extends \yii\console\Controller
{
    public function actionList(){
        $json=json_decode(file_get_contents("https://gitlab.com/prog-positron/test-app-vacancy/-/raw/master/books.json"));
        $date='$date';
        foreach ($json as $one_item){
            if(!Books::find()->andwhere(['ibsn'=>$one_item->isbn])->one()){
                $model=new Books();
                $model->updateBooksList($one_item);
            }
        }
        echo "Обновление списка книг завершено";
    }
}