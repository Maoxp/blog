<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/28
 * Time: 9:49
 */

namespace frontend\controllers;

use frontend\dao\ArticleDao;
use Yii;

class HomeController extends BaseController
{
    public function actions()
    {
        return [
            'page' => [
                'class' => 'yii\web\ViewAction'     //访问静态文件 home/page?view=about
            ]
        ];

    }

    public function actionEditWidget()
    {
        $model = ArticleDao::findOne(1);
        return $this->render('edit-widget',[
            'js_list' => [],
            'css_list' => [],
            "model" => $model
        ]);
    }

    public function actionEditMd($id=0)
    {
        $keyword = [];
        $error="";
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            if (empty($data['title']))
                $error = "标题不能为空";
            elseif (empty($data['subtitle']))
                $error = "摘要不能为空";

            if (empty($error)) {
                $keyword['title'] = $title = $data['title'];
                $keyword['subtitle'] = $subtitle = $data['subtitle'];
                $keyword['content'] = $editor_markdown_code = $data['editor_markdown_code'];
                ArticleDao::add([
                    "title" => $title,
                    "subtitle" => $subtitle,
                    "content" => $editor_markdown_code,
                    "author" => Yii::$app->user->identity->username,
                    "author_uid" => Yii::$app->user->id,
                    "created" => time(),
                ]);
            } else {
                Yii::$app->session->setFlash("message", ["type"=>"danger", "msg" => $error]);
            }

        } else {
            if (!empty($id)) {
                $data = ArticleDao::findOne($id);
                $keyword['title'] = $data->title;
                $keyword['subtitle'] = $data->subtitle;
                $keyword['content'] = $data->content;
            }

        }

        $this->layout="main-md.php";
        return $this->render('edit-md',[
            'js_list' => ["resource/editormd/editormd.js", "js/home/edit-md.js"],
            'css_list' => ["resource/editormd/css/editormd.min.css"],
            "keyword" => $keyword,
        ]);
    }

    public function actionTagAdd()
    {
        return json_encode(["status" => 1, "msg" => 'okokokok']);
    }

}