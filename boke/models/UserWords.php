<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_words".
 *
 * @property integer $id
 * @property string $keywords
 */
class UserWords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_words';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keywords'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'keywords' => '关键词',
        ];
    }
}
