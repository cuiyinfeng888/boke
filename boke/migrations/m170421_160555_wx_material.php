<?php

use yii\db\Migration;

class m170421_160555_wx_material extends Migration
{
    public function up()
    {
   $sql =<<<str
   CREATE TABLE `wx_material` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
          `media_id` varchar(64) NOT NULL DEFAULT '' COMMENT '媒体微信的id',
          `media_type` enum('image','voice','video','news') NOT NULL DEFAULT 'image' COMMENT '媒体的类型',
          `name` varchar(64) NOT NULL DEFAULT '' COMMENT '媒体名称',
          `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
          `url` varchar(200) NOT NULL DEFAULT '' COMMENT '媒体的链接url',
          PRIMARY KEY (`id`),
          KEY `md` (`media_id`) USING BTREE,
          KEY `n` (`name`) USING BTREE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信素材表';
str;
          Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170421_160555_wx_material cannot be reverted.\n";

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
