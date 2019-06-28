<?php
namespace frontend\controllers;

use common\models\User;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout= "mainLogin.php";

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (Yii::$app->request->isPost) {
            $model = new LoginForm();
            $model->username = Yii::$app->request->post("username");
            $model->password = Yii::$app->request->post("password");
            if ($model->login()) {
                return  $this->redirect(['default/index']);
            } else {
                $error = $model->getErrors();
            }
        }
        return $this->render('login', [
            "error" => $error ?? []
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model = new SignupForm();
            $model->username = $data['name'];
            $model->email = $data['email'];
            $model->password = $data['password'];
            if ($model->signup()) {
                return json_encode(['status' => 1, "msg" => '注册成功，请查看收邮件认证!']);
//                return $this->renderFile("@frontend/views/notification.php", [
//                    "auto" => true,
//                    "msg" => '注册成功，请查看收邮件认证!',
//                    "goto" => Url::to(['default/index'])
//                ]);
            } else {
                $error = $model->getErrors();
                return json_encode(['status' => 0, "msg" => '注册失败','data' => $error]);
            }
        }
    }

    public function actionVerifyEmail()
    {
        $token  = Yii::$app->request->get('token');
        $userInfo = new VerifyEmailForm($token);
        if ($userInfo->verifyEmail()) {
            exit("验证ok");
        } else {
            exit("验证失败");
        }
    }
}
