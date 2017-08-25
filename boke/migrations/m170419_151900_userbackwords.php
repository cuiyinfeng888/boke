<?php

use yii\db\Migration;

class m170419_151900_userbackwords extends Migration
{
    public function up()
    {
        $str = <<<str
     CREATE TABLE `user_back_words` (
          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
          `type` varchar(64) NOT NULL DEFAULT '' COMMENT '返回的类型',
          `backmedia` varchar(200) NOT NULL DEFAULT '' COMMENT '返回的内容',
          `kid` int(11) NOT NULL DEFAULT '0' COMMENT '所对应的关键词id',
          PRIMARY KEY (`id`),
          KEY `kid` (`kid`) USING BTREE,
          KEY `bw` (`backmedia`) USING BTREE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='返回给关注者的媒体表';
str;
        Yii::$app->db->createCommand($str)->execute();

    }

    public function down()
    {
        echo "m170419_151900_userbackwords cannot be reverted.\n";

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
