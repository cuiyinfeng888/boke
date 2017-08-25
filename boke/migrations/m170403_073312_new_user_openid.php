<?php

use yii\db\Migration;

class m170403_073312_new_user_openid extends Migration
{
    public function up()
    {
        $sql=<<<str
              CREATE TABLE `new_user_openid` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
                  `openid` varchar(64) NOT NULL,
                  `gettime` varchar(20) NOT NULL,
                  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已经处理，0为未处理，1为已经处理了',
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='刚刚关注者的openid临时存放表';
str;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function down()
    {
        echo "m170403_073312_new_user_openid cannot be reverted.\n";

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
