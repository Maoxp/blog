<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "db_article".
 *
 * @property int $id
 * @property string $title 文章标题
 * @property string $subtitle 子标题
 * @property string $content 文章内容
 * @property string $tag
 * @property int $reads 浏览量
 * @property string $author 发布人名称
 * @property int $author_uid
 * @property int $created 时间
 * @property int $flag 1:MD 2:富文本
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'author_uid'], 'required'],
            [['content'], 'string'],
            [['reads', 'author_uid', 'created', 'flag'], 'integer'],
            [['title', 'subtitle', 'tag', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'content' => 'Content',
            'tag' => 'Tag',
            'reads' => 'Reads',
            'author' => 'Author',
            'author_uid' => 'Author Uid',
            'created' => 'Created',
            'flag' => 'Flag',
        ];
    }
}
