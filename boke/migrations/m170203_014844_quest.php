<?php

use yii\db\Migration;

class m170203_014844_quest extends Migration
{
    public function up()
    {
        $sql = <<<str
               CREATE TABLE `quest` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
              `intro` tinytext COMMENT '简介',
              `content` text NOT NULL COMMENT '正文',
              `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序，数字越大，越靠前',
              `isshow` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示，0为不显示，1为显示',
              `create_time` varchar(20) NOT NULL COMMENT '添加时间',
              `praise_num` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
              `open_comment` int(1) NOT NULL DEFAULT '1' COMMENT '是否开启评论 1开启，2关闭',
              `show_comment` int(1) NOT NULL DEFAULT '1' COMMENT '是否显示评论 1为显示 2为不显示',
              `comment_num` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170203_014844_quest cannot be reverted.\n";

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
