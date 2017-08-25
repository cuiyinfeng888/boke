<?php

use yii\db\Migration;

class m170407_034303_redbag extends Migration
{
    public function up()
    {
          $sql =<<<str
           CREATE TABLE `redbag` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `openid` varchar(64) NOT NULL DEFAULT '' COMMENT '抽奖用户的openid',
              `money` decimal(6,2) unsigned DEFAULT '0.00' COMMENT '中奖金额 0为未中奖',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='红包表';
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170407_034303_redbag cannot be reverted.\n";

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
