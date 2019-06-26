<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/21
 * Time: 14:27
 */

namespace frontend\controllers;

use common\models\User;
use frontend\dao\Common;
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

    public function actionDetail()
    {
        return $this->render('detail',[
            'js_list' => ['resource/editormd/editormd.min.js', "js/editormd.js"],
            'css_list' => ['resource/editormd/css/editormd.min.css'],
        ]);
    }
}