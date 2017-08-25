<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_user".
 *
 * @property string $id
 * @property string $subscribe
 * @property string $openid
 * @property string $nickname
 * @property string $sex
 * @property string $language
 * @property string $city
 * @property string $province
 * @property string $country
 * @property string $headimgurl
 * @property string $subscribe_time
 * @property string $unionid
 * @property string $remark
 * @property string $groupid
 * @property string $tagid_list
 */
class WxUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscribe', 'sex', 'groupid'], 'integer'],
            [['openid', 'unionid'], 'string', 'max' => 64],
            [['nickname'], 'string', 'max' => 100],
            [['language', 'city', 'province', 'country'], 'string', 'max' => 20],
            [['headimgurl'], 'string', 'max' => 256],
            [['remark', 'tagid_list'], 'string', 'max' => 128],
            [['openid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subscribe' => 'Subscribe',
            'openid' => 'Openid',
            'nickname' => 'Nickname',
            'sex' => 'Sex',
            'language' => 'Language',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
            'headimgurl' => 'Headimgurl',
            'subscribe_time' => 'Subscribe Time',
            'unionid' => 'Unionid',
            'remark' => 'Remark',
            'groupid' => 'Groupid',
            'tagid_list' => 'Tagid List',
            'last_update_time'=>'last_update_time'
        ];
    }
}
