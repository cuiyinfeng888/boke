<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_material".
 *
 * @property string $id
 * @property string $media_id
 * @property string $media_type
 * @property string $name
 * @property integer $update_time
 * @property string $url
 */
class WxMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_type'], 'string'],
            [['update_time'], 'integer'],
            [['media_id', 'name'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'media_id' => '媒体微信的id',
            'media_type' => '媒体的类型',
            'name' => '媒体名称',
            'update_time' => '更新时间',
            'url' => '媒体的链接url',
        ];
    }
}
