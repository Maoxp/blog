<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/21
 * Time: 14:27
 */

namespace frontend\controllers;

use frontend\dao\ArticleDao;
use frontend\service\Common;
use frontend\service\Uploader;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    use Common;

    public function actionIndex()
    {
        $rows = Yii::$app->db->createCommand("select SQL_CALC_FOUND_ROWS * from db_article")->queryAll();
        $total= Yii::$app->db->createCommand("select found_rows() as total")->queryOne();

        $pagination = Common::createPage($total['total'], 10);
        return $this->render('index',[
            'js_list' => [],
            'css_list' => [],
            'page' => 1,
            'pageSize' => 10,
            'rows' => $rows,
            'total' => $total['total'],
            'pagination' => $pagination
        ]);
    }

//    public function actionEditWidget()
//    {
//        $model = Article::findOne(1);
//        return $this->render('edit-widget',[
//            'js_list' => [],
//            'css_list' => [],
//            "model" => $model
//        ]);
//    }
//
//    public function actionEditMd()
//    {
//        if (Yii::$app->request->isPost) {
//            $data = Yii::$app->request->post();
//            $title = $data['title'];
//            $subtitle = $data['subtitle'];
//            $editor_markdown_code = $data['editor_markdown_code'];
//            ArticleDao::add([
//                "title" => $title,
//                "subtitle" => $subtitle,
//                "content" => $editor_markdown_code,
//                "author" => Yii::$app->user->identity->username,
//                "author_uid" => Yii::$app->user->id,
//                "created" => time(),
//            ]);
//        }
//
//        $this->layout="main-md.php";
//        return $this->render('edit-md',[
//            'js_list' => ["resource/editormd/editormd.js"],
//            'css_list' => ["resource/editormd/css/editormd.min.css"],
//        ]);
//    }

    /**
     * 文章详情
     * @param $id
     * @return string
     */
    public function actionDetail($id)
    {
        $model = ArticleDao::findOne($id);
        $front_model = ArticleDao::findOne($id-1);
        $back_model = ArticleDao::findOne($id+1);

        return $this->render("detail",[
            "js_list" => [],
            "css_list" => [],
            "model" => $model,
            "front_model" => $front_model,
            "back_model" => $back_model,
        ]);
    }

    /**
     * 图片上传
     * @return string
     */
    public function actionUpload()
    {
        if (Yii::$app->request->isPost)
        {
            $upfile = new Uploader("editormd-image-file");
            $res = $upfile->do_load();
            if ($res) {
                return json_encode(['success' => 1, "message" => $upfile->stateInfo, "url" => Yii::$app->request->hostInfo.$res]);
            } else {
                return json_encode(['success' => 0, "message" => "ok", "url" => ""]);
            }
        }
    }
}