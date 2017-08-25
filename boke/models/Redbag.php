<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redbag".
 *
 * @property string $id
 * @property string $openid
 * @property string $money
 */
class Redbag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redbag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['money'], ''],
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
            'money' => 'Money',
        ];
    }
}
