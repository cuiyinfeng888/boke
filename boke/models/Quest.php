<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quest".
 *
 * @property string $id
 * @property string $title
 * @property string $intro
 * @property string $content
 * @property string $view_times
 * @property string $sort
 * @property integer $isshow
 * @property string $create_time
 * @property integer $praise_num
 * @property integer $open_comment
 * @property integer $show_comment
 * @property integer $comment_num
 */
class Quest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro', 'content'], 'string'],
            [['content', 'create_time'], 'required'],
            [['view_times', 'sort', 'isshow', 'praise_num', 'open_comment', 'show_comment', 'comment_num'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['create_time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'intro' => 'Intro',
            'content' => 'Content',
            'view_times' => 'View Times',
            'sort' => 'Sort',
            'isshow' => 'Isshow',
            'create_time' => 'Create Time',
            'praise_num' => 'Praise Num',
            'open_comment' => 'Open Comment',
            'show_comment' => 'Show Comment',
            'comment_num' => 'Comment Num',
        ];
    }
}
