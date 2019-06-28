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
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
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
            if (!empty($id)) {
                $data = ArticleDao::findOne($id);
                $keyword['title'] = $data->title;
                $keyword['subtitle'] = $data->subtitle;
                $keyword['content'] = $data->content;
            }

        }

        $this->layout="main-md.php";
        return $this->render('edit-md',[
            'js_list' => ["resource/editormd/editormd.js"],
            'css_list' => ["resource/editormd/css/editormd.min.css"],
            "keyword" => $keyword
        ]);
    }

}