<?php

use yii\db\Migration;

class m170419_151332_userwords extends Migration
{
    public function up()
    {
       $str = <<<str
      CREATE TABLE `user_words` (
          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
          `keywords` varchar(200) NOT NULL DEFAULT '' COMMENT '关键词',
          PRIMARY KEY (`id`),
          KEY `k` (`keywords`) USING BTREE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自动回复关键词表';
str;
         Yii::$app->db->createCommand($str)->execute();
    }

    public function down()
    {
        echo "m170419_151332_userwords cannot be reverted.\n";

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
