<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_token".
 *
 * @property string $id
 * @property string $access_token
 * @property string $gettime
 * @property string $expires_in
 */
class WxToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expires_in'], 'integer'],
            [['access_token'], 'string', 'max' => 256],
            [['gettime'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
            'gettime' => 'Gettime',
            'expires_in' => 'Expires In',
        ];
    }
}
