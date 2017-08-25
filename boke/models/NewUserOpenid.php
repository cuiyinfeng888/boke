<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "new_user_openid".
 *
 * @property string $id
 * @property string $openid
 * @property string $gettime
 * @property string $status
 */
class NewUserOpenid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_user_openid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'gettime'], 'required'],
            [['status'], 'integer'],
//            [['openid'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'gettime' => 'Gettime',
            'status' => 'Status',
        ];
    }
}
