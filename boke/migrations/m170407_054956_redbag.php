<?php

use yii\db\Migration;

class m170407_054956_redbag extends Migration
{
    public function up()
    {
        $sql=<<<str
         alter table redbag add status int(1) unsigned NOT NULL DEFAULT 0 COMMENT '是否已经发放，1为已经发放';
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170407_054956_redbag cannot be reverted.\n";

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
