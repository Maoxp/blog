<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/21
 * Time: 14:27
 */

namespace frontend\controllers;

use frontend\dao\ArticleDao;
use frontend\dao\TagDao;
use frontend\service\Common;
use frontend\service\Uploader;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class DefaultController extends Controller
{
    use Common;

    public function actionIndex()
    {
        $page = Yii::$app->request->get('page', 1);
        $pageSize =7;
        $offset = ($page -1) * $pageSize;

        if (Yii::$app->user->isGuest) {
            $where = "where status=1";
        } else {
            $where = "";
        }
        $rows = Yii::$app->db->createCommand("select SQL_CALC_FOUND_ROWS * from db_article {$where} limit $offset, $pageSize")->queryAll();
        $total = Yii::$app->db->createCommand("select found_rows() as total")->queryOne();

        $pagination = Common::createPage($total['total'], $pageSize);
        return $this->render('index', [
            'js_list' => [],
            'css_list' => [],
            'page' => $page,
            'pageSize' => $pageSize,
            'rows' => $rows,
            'total' => $total['total'],
            'pagination' => $pagination
        ]);
    }

    /**
     * 文章详情
     * @param $id
     * @return string
     */
    public function actionDetail($id)
    {
        $model = ArticleDao::findOne($id);
        $model->reads += 1;
        $model->save();

        return $this->render("detail", [
            "js_list" => [],
            "css_list" => [],
            "model" => $model,
            "front_model" => ArticleDao::findOne($id - 1),
            "back_model" => ArticleDao::findOne($id + 1),
        ]);
    }

    /**
     * 图片上传
     * @return string
     */
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $upFile = new Uploader("editormd-image-file");
            $res = $upFile->do_load();
            if ($res) {
                return json_encode(['success' => 1, "message" => $upFile->stateInfo, "url" => Yii::$app->request->hostInfo . $res]);
            } else {
                return json_encode(['success' => 0, "message" => "ok", "url" => ""]);
            }
        }
    }

    //归档
    public function actionTag()
    {
        $rows = TagDao::find()->select("id, name, aticle_count")->all();
        return $this->render("tag", [
            "js_list" => [],
            "css_list" => [],
            "rows" => $rows
        ]);
    }

    public function actionList(int $id = 0)
    {
        $this->layout = 'main-md';
        if ($id == 0) {
            return $this->renderFile("@frontend/views/notification.php", [
                "auto" => true,
                "msg" => '缺少参数!',
                "goto" => Url::to(['default/tag'])
            ]);
        }
        $page = Yii::$app->request->get('page', 1);
        $pageSize =20;
        $offset = ($page -1) * $pageSize;

        $rows = Yii::$app->db->createCommand("select SQL_CALC_FOUND_ROWS * from db_article where tag_id=$id limit $offset, $pageSize")->queryAll();
        $total = Yii::$app->db->createCommand("select found_rows() as total")->queryOne();

        $pagination = Common::createPage($total['total'], $pageSize);
        return $this->render('list', [
            'js_list' => [],
            'css_list' => [],
            'page' => $page,
            'pageSize' => $pageSize,
            'rows' => $rows,
            'total' => $total['total'],
            'pagination' => $pagination
        ]);
    }


}