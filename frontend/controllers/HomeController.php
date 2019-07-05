<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/28
 * Time: 9:49
 */

namespace frontend\controllers;

use frontend\dao\ArticleDao;
use frontend\dao\TagDao;
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

    public function actionEditMd(int $id=0)
    {
//        var_dump($id);
//        var_dump( Yii::$app->request->post());
//        die();

        $keyword = [];
        $error="";
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $keyword['title'] = $title = $data['title'];
            $keyword['subtitle'] = $subtitle = $data['subtitle'];
            $keyword['content'] = $editor_markdown_code = $data['editor_markdown_code'];
            $keyword['tag_id'] = $tag_id = $data['tag_id'];
            $keyword['status'] = $status = $data['status'];

            if (empty($data['title']))
                $error = "标题不能为空";
            elseif (empty($data['subtitle']))
                $error = "摘要不能为空";
            elseif (empty($data['tag_id']))
                $error = "标签不能为空";
            elseif (empty($data['status']))
                $error = "请选择可见范围";

            if (empty($error)) {
                $res = ArticleDao::add_or_edit([
                    "title" => $title,
                    "subtitle" => $subtitle,
                    "content" => $editor_markdown_code,
                    "tag_id" => $tag_id,
                    "status" => $status,
                    "author" => Yii::$app->user->identity->username,
                    "author_uid" => Yii::$app->user->id,
                    "created" => time(),
                ], $id);
                if (!is_bool($res)) {
                    Yii::$app->session->setFlash("message", ["type"=>"danger", "msg" => $res]);
                }  else {
                    return $this->redirect(['default/index']);
                }
            } else {
                Yii::$app->session->setFlash("message", ["type"=>"danger", "msg" => $error]);
            }
        } else {
            //编辑
            if (!empty($id)) {
                $data = ArticleDao::findOne($id);
                $keyword['title'] = $data->title;
                $keyword['subtitle'] = $data->subtitle;
                $keyword['content'] = $data->content;
                $keyword['tag_id'] = $data->tag_id;
                $keyword['status'] = $data->status;
            }
        }


        $this->layout="main-md.php";
        return $this->render('edit-md',[
            'js_list' => ["resource/editormd/editormd.js", "js/home/edit-md.js"],
            'css_list' => ["resource/editormd/css/editormd.min.css"],
            "keyword" => $keyword,
            "action" => $id ? "/home/edit-md?id=1" : "/home/edit-md",
            "tag" => TagDao::find()->select("id, name")->all()
        ]);
    }

    /**
     * 归档标签
     *
     * @return array|string
     */
    public function actionTagAdd()
    {
        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post('tagName', '');
            if (empty($name)) {
                return ["status" => 0, 'msg' => '标签名不能为空'];
            }
            $res = TagDao::add($name);
            return json_encode($res);
        }
    }

}