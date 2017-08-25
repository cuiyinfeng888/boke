<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $cate_name
 * @property string $sort
 * @property string $isshow
 * @property string $q_sort
 * @property string $create_time
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'isshow'], 'integer'],
            [['cate_name', 'q_sort'], 'string', 'max' => 60],
            [['create_time'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cate_name' => 'Cate Name',
            'sort' => 'Sort',
            'isshow' => 'Isshow',
            'q_sort' => 'Q Sort',
            'create_time' => 'Create Time',
        ];
    }
}
