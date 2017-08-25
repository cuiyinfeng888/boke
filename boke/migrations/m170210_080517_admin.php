<?php

use yii\db\Migration;

class m170210_080517_admin extends Migration
{
    public function up()
    {
        $sql =<<<str
     CREATE TABLE `admin` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
          `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
          `userType` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '用户类型即等级',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户表';
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170210_080517_admin cannot be reverted.\n";

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
