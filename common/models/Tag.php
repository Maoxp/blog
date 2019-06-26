<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "db_tag".
 *
 * @property int $id
 * @property string $name
 * @property int $aticle_count 文章统计数量
 * @property int $status 有效1 无效-1
 * @property int $created
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'aticle_count', 'status', 'created'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'aticle_count' => 'Aticle Count',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }
}
