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
    public static function add_or_edit($data, $id)
    {
        try {
            if ($id) {
                Yii::$app->db->createCommand("update db_tag set aticle_count=aticle_count -1 where id=".self::findOne($id)->tag_id)->execute();
                Yii::$app->db->createCommand()->update("db_article", $data, "id=$id")->execute();
            } else {
                Yii::$app->db->createCommand()->insert("db_article", $data)->execute();
            }
            Yii::$app->db->createCommand("update db_tag set aticle_count=aticle_count +1 where id={$data['tag_id']}")->execute();
            return true;
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

}