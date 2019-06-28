<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/27
 * Time: 16:56
 */
namespace frontend\dao;

use common\models\Article;
use Yii;

class ArticleDao extends Article
{
    public static function add($data)
    {
        try {
            Yii::$app->db->createCommand()->insert("db_article", $data)->execute();
            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}