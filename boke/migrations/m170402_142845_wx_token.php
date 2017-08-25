<?php

use yii\db\Migration;

class m170402_142845_wx_token extends Migration
{
    public function up()
    {
        $sql =<<<str
           CREATE TABLE `wx_token` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `access_token` varchar(256) NOT NULL DEFAULT '' COMMENT '微信调取接口的凭证',
              `gettime` varchar(20) NOT NULL DEFAULT '' COMMENT '获取时间',
              `expires_in` int(11) unsigned NOT NULL DEFAULT '7000' COMMENT '有效期，实际值为7200，这里取7000',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信access_token表';
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170402_142845_wx_token cannot be reverted.\n";

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
