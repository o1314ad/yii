<?php
namespace frontend\controllers;


use Yii;
use common\models\Message;
use yii\web\Controller;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;


class MessageController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        $model = new Message();
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->contact('yourmail@gmail.com')) {
            return $this->render('success', []);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSend()
    {

    }
}
