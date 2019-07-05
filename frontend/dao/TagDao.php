<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/7/4
 * Time: 9:24
 */

namespace frontend\dao;

use Yii;
use common\models\Tag;

class TagDao extends Tag
{
    public static function add($name)
    {
        $column = [];
        $tmp = explode(",", $name);
        foreach ($tmp as $value) {
            $column[] = ["name" => $value, "created" => time()];
        }
        try {
            Yii::$app->db->createCommand()->batchInsert("db_tag", ['name', "created"], $column)->execute();
            return ['status' => 1, 'msg' => '添加成功'];
        } catch (\Throwable $exception) {
            return ['status' => 0, 'msg' => $exception->getMessage()];
        }
    }
}