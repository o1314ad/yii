<?php

namespace frontend\controllers;

use common\models\Post;
use yii\web\NotFoundHttpException;

class PostController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $posts=Post::find()->orderBy("sort")->all();
        return $this->render('index',['posts'=>$posts]);
    }
    public function actionOne($url){

        if($post=Post::find()->where(['url'=>$url])->one()){
            return $this->render('one',['post'=>$post]);
        }
        throw new NotFoundHttpException("Ошибка 404 страница не найдена");

    }

}
