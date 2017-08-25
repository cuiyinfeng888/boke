<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_back_word".
 *
 * @property integer $id
 * @property string $type
 * @property string $backmedia
 * @property integer $kid
 */
class UserBackWord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_back_word';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kid'], 'integer'],
            [['type'], 'string', 'max' => 64],
            [['backmedia'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'type' => '返回的类型',
            'backmedia' => '返回的内容',
            'kid' => '所对应的关键词id',
        ];
    }
}
