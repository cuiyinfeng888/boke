<?php

use yii\db\Migration;

class m170209_091042_quest extends Migration
{
    public function up()
    {
        $sql =<<<str
     alter table quest add view_times int(11) unsigned NOT NULL DEFAULT '0' COMMENT '访问次数' after content;
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170209_091042_quest cannot be reverted.\n";

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
