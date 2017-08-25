<?php

use yii\db\Migration;

class m170122_085931_category extends Migration
{
    public function up()
    {
       $sql =<<<str
             CREATE TABLE `category` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
              `cate_name` varchar(60) NOT NULL DEFAULT '' COMMENT '分类名称',
              `sort` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
              `isshow` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示，1为显示，2为不显示',
              `q_sort` varchar(60) NOT NULL DEFAULT '' COMMENT '属于此分类的问题的排序字段',
              `create_time` varchar(30) NOT NULL DEFAULT '' COMMENT '分类添加时间',
              PRIMARY KEY (`id`),
              KEY `catename` (`cate_name`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
str;
            Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170122_085931_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
